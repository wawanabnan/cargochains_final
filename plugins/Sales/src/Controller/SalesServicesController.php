<?php
declare(strict_types=1);

namespace Sales\Controller;

use Sales\Controller\AppController;

/**
 * SalesServices Controller
 *
 * @property \Sales\Model\Table\SalesServicesTable $SalesServices
 */
class SalesServicesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->SalesServices->find()
            ->contain(['ParentSalesServices']);
        $salesServices = $this->paginate($query);

        $this->set(compact('salesServices'));
    }

    /**
     * View method
     *
     * @param string|null $id Sales Service id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesService = $this->SalesServices->get($id, contain: ['ParentSalesServices', 'SalesOrders', 'SalesQuotations', 'ChildSalesServices']);
        $this->set(compact('salesService'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesService = $this->SalesServices->newEmptyEntity();
        if ($this->request->is('post')) {
            $salesService = $this->SalesServices->patchEntity($salesService, $this->request->getData());
            if ($this->SalesServices->save($salesService)) {
                $this->Flash->success(__('The sales service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales service could not be saved. Please, try again.'));
        }
        $parentSalesServices = $this->SalesServices->ParentSalesServices->find('list', limit: 200)->all();
        $this->set(compact('salesService', 'parentSalesServices'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Service id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesService = $this->SalesServices->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesService = $this->SalesServices->patchEntity($salesService, $this->request->getData());
            if ($this->SalesServices->save($salesService)) {
                $this->Flash->success(__('The sales service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales service could not be saved. Please, try again.'));
        }
        $parentSalesServices = $this->SalesServices->ParentSalesServices->find('list', limit: 200)->all();
        $this->set(compact('salesService', 'parentSalesServices'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Service id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesService = $this->SalesServices->get($id);
        if ($this->SalesServices->delete($salesService)) {
            $this->Flash->success(__('The sales service has been deleted.'));
        } else {
            $this->Flash->error(__('The sales service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
