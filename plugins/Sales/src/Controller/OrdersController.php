<?php
declare(strict_types=1);

namespace Sales\Controller;

class OrdersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Sales.Orders');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['OrderLines'],
            'order' => ['Orders.created' => 'DESC'],
            'limit' => 20,
        ];
        $salesOrders = $this->paginate($this->SalesOrders);
        $this->set(compact('Orders'));
    }

    public function view($id = null)
    {
        $Order = $this->Orders->get($id, [
            'contain' => ['OrderLines'],
        ]);
        $this->set(compact('Order'));
    }

    public function add()
    {
        $entity = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!empty($data['order_lines'])) {
                foreach ($data['order_lines'] as &$ln) {
                    $qty = (float)($ln['qty'] ?? 0);
                    $price = (float)($ln['price'] ?? 0);
                    $ln['amount'] = round($qty * $price, 2);
                }
            }
            $entity = $this->Orders->patchEntity($entity, $data, [
                'associated' => ['OrderLines']
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
        $entity = $this->sOrders->get($id, ['contain' => ['OrderLines']]);
        if ($this->request->is(['patch','post','put'])) {
            $data = $this->request->getData();
            if (!empty($data['order_lines'])) {
                foreach ($data['order_lines'] as &$ln) {
                    $qty = (float)($ln['qty'] ?? 0);
                    $price = (float)($ln['price'] ?? 0);
                    $ln['amount'] = round($qty * $price, 2);
                }
            }
            $entity = $this->Orders->patchEntity($entity, $data, [
                'associated' => ['OrderLines']
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
        $entity = $this->Orders->get($id);
        if ($this->Orders->delete($entity)) {
            $this->Flash->success('Deleted');
        } else {
            $this->Flash->error('Delete failed');
        }
        return $this->redirect(['action' => 'index']);
    }
}
