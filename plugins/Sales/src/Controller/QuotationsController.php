<?php
declare(strict_types=1);

namespace Sales\Controller;

use Sales\Controller\AppController;

/**
 * Quotations Controller
 *
 * @property \Sales\Model\Table\QuotationsTable $Quotations
 */
class QuotationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
	 
    public function initialize(): void
    {
        parent::initialize();
		$this->paginate = [
            'limit' => 20,
            'order' => ['Quotations.created' => 'DESC'],
            'sortableFields' => [
                'Quotations.code', 'Quotations.created', 'Quotations.status', 'Quotations.total',
                'Customer.name', 'Quotations.quotation_date',
				'PaymentTerms.name', // ✅ bisa sort di header

            ],
        ];
	}

    public function index()
    {
		
		$q      = trim((string)$this->request->getQuery('q', ''));
        $status = $this->request->getQuery('status');
        $from   = $this->request->getQuery('from');
        $to     = $this->request->getQuery('to');
        $group  = $this->request->getQuery('group');

        // contain utk render relasi; join utk filter/sort di kolom relasi
        $query = $this->Quotations->find()
            ->contain(['Customer','PaymentTerms','SalesServices'])
            ->leftJoinWith('Customer'); // penting agar WHERE/ORDER di Customer.* berfungsi

        if ($q !== '') {
            $query->where([
                'OR' => [
                    'Quotations.code LIKE'  => "%{$q}%",
                    'Customer.name LIKE'    => "%{$q}%",
                ]
            ]);
        }

        if (!empty($status)) {
            $query->where(['Quotations.status' => $status]);
        }

        if (!empty($from)) {
            $query->where(['Quotations.quotation_date >=' => new FrozenDate($from)]);
        }
		
		 if (!empty($to)) {
            $query->where(['Quotations.quotation_date <=' => new FrozenDate($to)]);
        }

        // "Group By" di UI cukup kita terjemahkan jadi pengurutan
        if ($group === 'status') {
            $query->orderAsc('Quotations.status')->orderDesc('Quotations.created');
        } elseif ($group === 'customer') {
            $query->orderAsc('Customer.name')->orderDesc('Quotations.created');
        }

        $quotations = $this->paginate($query);
        $this->set(compact('quotations'));
		
		
    }

	 public function bulk()
    {
        $this->request->allowMethod(['post']);
        $ids    = (array)$this->request->getData('ids');
        $action = $this->request->getData('bulk_action');

        if (!$ids || !$action) {
            $this->Flash->error(__('Please select quotations and an action.'));
            return $this->redirect(['action' => 'index']);
        }

        switch ($action) {
            case 'status':
                // contoh sederhana: set APPROVED; bisa kamu ganti baca dari input status baru
                $this->Quotations->updateAll(['status' => 'APPROVED'], ['id IN' => $ids]);
                $this->Flash->success(__('Status updated for selected quotations.'));
                break;

            case 'export':
                // TODO: implement export (CSV/PDF)
                $this->Flash->success(__('Export triggered for selected quotations.'));
                break;

            case 'email':
                // TODO: implement mailer
                $this->Flash->success(__('Email queued for selected quotations.'));
                break;

            case 'po':
                // TODO: implement generate PO
                $this->Flash->success(__('PO generated for selected quotations.'));
                break;

            default:
                $this->Flash->error(__('Invalid action.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function view($id = null)
    {
        $quotation = $this->Quotations->get($id, contain: ['Customer']);
        $this->set(compact('quotation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quotation = $this->Quotations->newEmptyEntity();
        if ($this->request->is('post')) {
            $quotation = $this->Quotations->patchEntity($quotation, $this->request->getData());
            if ($this->Quotations->save($quotation)) {
                $this->Flash->success(__('The quotation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quotation could not be saved. Please, try again.'));
        }
        $customer = $this->Quotations->Customer->find('list', limit: 200)->all();
        $this->set(compact('quotation', 'customer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Quotation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quotation = $this->Quotations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quotation = $this->Quotations->patchEntity($quotation, $this->request->getData());
            if ($this->Quotations->save($quotation)) {
                $this->Flash->success(__('The quotation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quotation could not be saved. Please, try again.'));
        }
        $customer = $this->Quotations->Customer->find('list', limit: 200)->all();
        $this->set(compact('quotation', 'customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Quotation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quotation = $this->Quotations->get($id);
        if ($this->Quotations->delete($quotation)) {
            $this->Flash->success(__('The quotation has been deleted.'));
        } else {
            $this->Flash->error(__('The quotation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
