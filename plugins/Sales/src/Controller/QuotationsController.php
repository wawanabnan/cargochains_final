<?php
declare(strict_types=1);

namespace Sales\Controller;

use Cake\I18n\FrozenDate;
use Cake\Http\Exception\NotFoundException;

class QuotationsController extends AppController
{
    private const SESSION_KEY = 'Sales.Quotation.header';

    /**
     * INDEX: daftar quotation
     */
    public function index()
    {
        $query = $this->Quotations->find()
        ->contain([
            'Customers',
            'SalesServices' => ['ParentServices'],
            'PaymentTerms',
        ]);

    $quotations = $this->paginate(
        $query,
        [
            'order' => ['Quotations.created' => 'DESC'],
            'limit' => 20,
        ]
    );

    $this->set(compact('quotations'));

    }

    /**
     * VIEW: detail quotation
     */
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException('ID tidak valid');
        }

        $quotation = $this->Quotations->get($id, [
            'contain' => [
                'Customers',
                'SalesServices' => ['ParentServices'],
                'PaymentTerms',
                'QuotationLines' => ['Origin','Destination'],
            ],
        ]);

        $this->set(compact('quotation'));
    }

    /**
     * ADD STEP-1: Header
     */
    public function add()
    {
        $quotation = $this->Quotations->newEmptyEntity();
        $session   = $this->request->getSession();

        $prefill = (array)$session->read(self::SESSION_KEY);
        if (empty($prefill['valid_until'])) {
            $prefill['valid_until'] = FrozenDate::today()->addDays(7)->format('Y-m-d');
        }
        if ($prefill) {
            $quotation = $this->Quotations->patchEntity($quotation, $prefill, ['validate' => false]);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData() + [
                'business_type' => 'freight',
                'status'        => 'DRAFT',
            ];
            $tmp = $this->Quotations->newEntity($data, ['validate' => 'header']);
            if ($tmp->getErrors()) {
                $this->Flash->error('Header belum valid. Periksa input yang ditandai.');
                $quotation = $tmp;
            } else {
                $session->write(self::SESSION_KEY, $data);
                return $this->redirect(['action' => 'lines']);
            }
        }

        // dropdowns
        $CustomersTbl = $this->fetchTable('Partners.Customers');
        $customers = $CustomersTbl
            ->find('asCustomers')
            ->find('list', ['keyField' => 'id', 'valueField' => 'name'])
            ->orderAsc($CustomersTbl->aliasField('name'))
            ->all();

        $paymentTerms   = $this->fetchTable('Sales.PaymentTerms')->find('list')->orderAsc('name')->all();
        $serviceOptions = $this->serviceOptionsParentChildFlat();

        $this->set(compact('quotation','customers','paymentTerms','serviceOptions'));
    }

    /**
     * ADD STEP-2: Lines + final save (atomic)
     */
    public function lines()
    {
        $session = $this->request->getSession();
        $header  = (array)$session->read(self::SESSION_KEY);
        if (!$header) {
            $this->Flash->warning('Header belum diisi.');
            return $this->redirect(['action' => 'add']);
        }

        $quotation = $this->Quotations->newEmptyEntity();

        if ($this->request->is(['post','put','patch'])) {
            $lines = (array)$this->request->getData('quotation_lines');
            foreach ($lines as &$ln) {
                foreach (['origin_id','destination_id'] as $k) {
                    if (isset($ln[$k]) && $ln[$k] !== '') $ln[$k] = (int)$ln[$k];
                }
                foreach (['qty','rate'] as $num) {
                    if (isset($ln[$num]) && $ln[$num] !== '') {
                        $v = (string)$ln[$num];
                        $v = str_replace('.', '', $v);
                        $v = str_replace(',', '.', $v);
                        $ln[$num] = $v;
                    }
                }
            }
            unset($ln);

            $payload = $header;
            $payload['quotation_lines'] = $lines;

            $quotation = $this->Quotations->newEntity($payload, [
                'associated' => ['QuotationLines']
            ]);

            if ($this->Quotations->save($quotation, ['atomic'=>true])) {
                $session->delete(self::SESSION_KEY);
                $this->Flash->success('Quotation berhasil disimpan.');
                return $this->redirect(['action' => 'view', $quotation->id]);
            }

            // tampilkan error detail
            $errors = $quotation->getErrors();
            if ($errors) {
                $human = [];
                foreach ($errors as $field => $errs) {
                    if ($field === 'quotation_lines' && is_array($errs)) {
                        foreach ($errs as $idx => $lineErrs) {
                            foreach ($lineErrs as $f => $msgs) {
                                $msg = is_array($msgs) ? implode(', ', $msgs) : $msgs;
                                $human[] = "Line #".((int)$idx+1)." — {$f}: {$msg}";
                            }
                        }
                    } else {
                        $human[] = $field.': '.(is_array($errs)?implode(', ',$errs):$errs);
                    }
                }
                $this->Flash->error('Gagal menyimpan:<br>'.implode('<br>', array_map('h',$human)), ['escape'=>false]);
            } else {
                $this->Flash->error('Gagal menyimpan. Periksa input yang ditandai.');
            }
        }

        // header summary labels
        $headerSummary = $header;
        if (!empty($header['customer_id'])) {
            $Cust = $this->fetchTable('Partners.Customers')
                ->find('asCustomers')->select(['id','name'])
                ->where(['Customers.id' => $header['customer_id']])->first();
            if ($Cust) $headerSummary['customer_label'] = $Cust->name;
        }
        if (!empty($header['payment_term_id'])) {
            $PT = $this->fetchTable('Sales.PaymentTerms')->find()->select(['id','name'])
                ->where(['id' => $header['payment_term_id']])->first();
            if ($PT) $headerSummary['payment_term_label'] = $PT->name;
        }
        if (!empty($header['sales_service_id'])) {
            $Svc = $this->fetchTable('Sales.SalesServices')->find()
                ->contain(['ParentServices' => fn($q)=>$q->select(['id','name'])])
                ->select(['id','name','parent_id'])
                ->where(['SalesServices.id' => $header['sales_service_id']])
                ->first();
            if ($Svc) {
                $headerSummary['service_label'] = $Svc->parent_service
                    ? $Svc->parent_service->name.' – '.$Svc->name
                    : $Svc->name;
            }
        }

        // locations
        $Locations   = $this->fetchTable('Geo.Locations');
        $valueField  = $Locations->getDisplayField(); // bisa 'full_name'
        $locationOptions = $Locations->find('list', [
                'keyField' => 'id',
                'valueField' => $valueField
            ])->orderAsc($valueField)->all();

        $this->set(compact('quotation','headerSummary','locationOptions'));
    }

    /**
     * BULK: contoh aksi massal (misal ubah status jadi CONFIRMED)
     */
    public function bulk()
    {
        if ($this->request->is('post')) {
            $ids    = (array)$this->request->getData('ids');       // array of id
            $status = $this->request->getData('status') ?? 'DRAFT';

            if ($ids) {
                $this->Quotations->updateAll(
                    ['status' => $status],
                    ['id IN' => $ids]
                );
                $this->Flash->success(count($ids)." quotation(s) updated to {$status}.");
            } else {
                $this->Flash->warning('Tidak ada quotation yang dipilih.');
            }
            return $this->redirect(['action'=>'index']);
        }

        // default tampilkan daftar untuk pilih bulk
        return $this->redirect(['action'=>'index']);
    }

    // ==== UTIL ====
    private function serviceOptionsParentChildFlat(): array
    {
        $Services = $this->fetchTable('Sales.SalesServices');

        $q = $Services->find()
            ->select([
                'id'          => 'SalesServices.id',
                'name'        => 'SalesServices.name',
                'parent_name' => 'ParentServices.name',
            ])
            ->contain(['ParentServices' => fn($qq)=>$qq->select(['id','name'])])
            ->whereNotNull('SalesServices.parent_id');

        $orderCase = $q->newExpr("
            CASE ParentServices.name
                WHEN 'Sea'  THEN 1
                WHEN 'Air'  THEN 2
                WHEN 'Land' THEN 3
                ELSE 99
            END
        ");

        $rows = $q->order([$orderCase, 'ParentServices.name'=>'ASC', 'SalesServices.name'=>'ASC'])
                  ->enableHydration(false)->toArray();

        $opts = [];
        foreach ($rows as $r) {
            $opts[$r['id']] = ($r['parent_name'] ? $r['parent_name'].' – ' : '').$r['name'];
        }
        return $opts;
    }
}
