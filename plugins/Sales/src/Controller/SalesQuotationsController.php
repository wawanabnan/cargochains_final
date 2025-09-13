<?php
declare(strict_types=1);

namespace Sales\Controller;

use App\Controller\AppController;

/**
 * SalesQuotations Controller
 *
 * @property \Sales\Model\Table\SalesQuotationsTable $SalesQuotations
 */
class SalesQuotationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		
		debug ("TEST");die;
        $query = $this->SalesQuotations->find();
        $salesQuotations = $this->paginate($query);

        $this->set(compact('salesQuotations'));
    }

    /**
     * View method
     *
     * @param string|null $id Sales Quotation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesQuotation = $this->SalesQuotations->get($id, contain: ['SalesQuotationLines']);
        $this->set(compact('salesQuotation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesQuotation = $this->SalesQuotations->newEmptyEntity();
        if ($this->request->is('post')) {
            $salesQuotation = $this->SalesQuotations->patchEntity($salesQuotation, $this->request->getData());
            if ($this->SalesQuotations->save($salesQuotation)) {
                $this->Flash->success(__('The sales quotation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales quotation could not be saved. Please, try again.'));
        }
        $this->set(compact('salesQuotation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Quotation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesQuotation = $this->SalesQuotations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesQuotation = $this->SalesQuotations->patchEntity($salesQuotation, $this->request->getData());
            if ($this->SalesQuotations->save($salesQuotation)) {
                $this->Flash->success(__('The sales quotation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales quotation could not be saved. Please, try again.'));
        }
        $this->set(compact('salesQuotation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Quotation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesQuotation = $this->SalesQuotations->get($id);
        if ($this->SalesQuotations->delete($salesQuotation)) {
            $this->Flash->success(__('The sales quotation has been deleted.'));
        } else {
            $this->Flash->error(__('The sales quotation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
