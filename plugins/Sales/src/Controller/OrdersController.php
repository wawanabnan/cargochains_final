<?php
declare(strict_types=1);

namespace Sales\Controller;

use Cake\I18n\FrozenDate;

class OrdersController extends AppController
{
    protected $modelClass = 'Sales.SalesOrders';

    public function add(?int $quotationId = null)
    {
        $order = $this->SalesOrders->newEmptyEntity();

        if ($quotationId) {
            $Quotation = $this->fetchTable('Sales.Quotations')->get($quotationId, [
                'contain' => ['Customer', 'PaymentTerms', 'SalesServices']
            ]);
            $order->quotation_id     = $Quotation->id;
            $order->customer_id      = $Quotation->customer_id;
            $order->sales_service_id = $Quotation->sales_service_id ?? null;
            $order->payment_term_id  = $Quotation->payment_term_id ?? null;
            $order->business_type    = $Quotation->business_type ?? 'freight';
            $order->order_date       = FrozenDate::today();
            $order->status           = 'OPEN';
            $order->total            = $Quotation->total ?? null;
            $this->Flash->info(__('Prefilled from quotation {0}', h($Quotation->code)));
        }

        if ($this->request->is('post')) {
            $order = $this->SalesOrders->patchEntity($order, $this->request->getData());
            if (empty($order->order_date)) {
                $order->order_date = FrozenDate::today();
            }
            if (empty($order->business_type)) {
                $order->business_type = 'freight';
            }

            if ($this->SalesOrders->save($order)) {
                $this->Flash->success(__('Order saved: {0}', h($order->code)));
                return $this->redirect(['action' => 'view', $order->id]);
            }
            $this->Flash->error(__('Unable to save order.'));
        }

        $Partners = $this->fetchTable('Partners.Partners');
        $customers = $Partners->find('list', keyField:'id', valueField:'name')->orderAsc('name')->toArray();

        $PaymentTerms = $this->fetchTable('Sales.PaymentTerms');
        $paymentTermsList = $PaymentTerms->find('list', keyField:'id', valueField:'name')->orderAsc('name')->toArray();

        $SalesServices = $this->fetchTable('Sales.SalesServices');
        $services = $SalesServices->find('list', keyField:'id', valueField:'name')->orderAsc('name')->toArray();

        $this->set(compact('order','customers','paymentTermsList','services'));
    }
}
