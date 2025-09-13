<?php
declare(strict_types=1);

namespace Sales\Controller;

class SalesOrdersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Sales.SalesOrders');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['SalesOrderLines'],
            'order' => ['SalesOrders.created' => 'DESC'],
            'limit' => 20,
        ];
        $salesOrders = $this->paginate($this->SalesOrders);
        $this->set(compact('salesOrders'));
    }

    public function view($id = null)
    {
        $salesOrder = $this->SalesOrders->get($id, [
            'contain' => ['SalesOrderLines'],
        ]);
        $this->set(compact('salesOrder'));
    }

    public function add()
    {
        $entity = $this->SalesOrders->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!empty($data['sales_order_lines'])) {
                foreach ($data['sales_order_lines'] as &$ln) {
                    $qty = (float)($ln['qty'] ?? 0);
                    $price = (float)($ln['price'] ?? 0);
                    $ln['amount'] = round($qty * $price, 2);
                }
            }
            $entity = $this->SalesOrders->patchEntity($entity, $data, [
                'associated' => ['SalesOrderLines']
            ]);
            if ($this->SalesOrders->save($entity)) {
                $this->Flash->success('Order created');
                return $this->redirect(['action' => 'view', $entity->id]);
            }
            $this->Flash->error('Failed to save');
        }
        $this->set(compact('entity'));
    }

    public function edit($id = null)
    {
        $entity = $this->SalesOrders->get($id, ['contain' => ['SalesOrderLines']]);
        if ($this->request->is(['patch','post','put'])) {
            $data = $this->request->getData();
            if (!empty($data['sales_order_lines'])) {
                foreach ($data['sales_order_lines'] as &$ln) {
                    $qty = (float)($ln['qty'] ?? 0);
                    $price = (float)($ln['price'] ?? 0);
                    $ln['amount'] = round($qty * $price, 2);
                }
            }
            $entity = $this->SalesOrders->patchEntity($entity, $data, [
                'associated' => ['SalesOrderLines']
            ]);
            if ($this->SalesOrders->save($entity)) {
                $this->Flash->success('Order updated');
                return $this->redirect(['action' => 'view', $entity->id]);
            }
            $this->Flash->error('Failed to update');
        }
        $this->set(compact('entity'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post','delete']);
        $entity = $this->SalesOrders->get($id);
        if ($this->SalesOrders->delete($entity)) {
            $this->Flash->success('Deleted');
        } else {
            $this->Flash->error('Delete failed');
        }
        return $this->redirect(['action' => 'index']);
    }
}
