<?php
declare(strict_types=1);

namespace Shipments\Controller;
use Shipments\Controller\AppController;

class ShipmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		
	    $query = $this->Shipments->find()
            ->contain(['Shipper', 'Consignee', 'Carrier', 'Agency']);
        $shipments = $this->paginate($query);

			
        $this->set(compact('shipments'));
    }

    /**
     * View method
     *
     * @param string|null $id Shipment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shipment = $this->Shipments->get($id, contain: ['Shipper', 'Consignee', 'Carrier', 'Agency', 'ShipmentRoutes', 'ShipmentDocuments']);
        $this->set(compact('shipment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shipment = $this->Shipments->newEmptyEntity();
        if ($this->request->is('post')) {
            $shipment = $this->Shipments->patchEntity($shipment, $this->request->getData());
            if ($this->Shipments->save($shipment)) {
                $this->Flash->success(__('The shipment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipment could not be saved. Please, try again.'));
        }
        $shipper = $this->Shipments->Shipper->find('list', limit: 200)->all();
        $consignee = $this->Shipments->Consignee->find('list', limit: 200)->all();
        $carrier = $this->Shipments->Carrier->find('list', limit: 200)->all();
        $agency = $this->Shipments->Agency->find('list', limit: 200)->all();
        $this->set(compact('shipment', 'shipper', 'consignee', 'carrier', 'agency'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shipment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shipment = $this->Shipments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shipment = $this->Shipments->patchEntity($shipment, $this->request->getData());
            if ($this->Shipments->save($shipment)) {
                $this->Flash->success(__('The shipment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipment could not be saved. Please, try again.'));
        }
        $shipper = $this->Shipments->Shipper->find('list', limit: 200)->all();
        $consignee = $this->Shipments->Consignee->find('list', limit: 200)->all();
        $carrier = $this->Shipments->Carrier->find('list', limit: 200)->all();
        $agency = $this->Shipments->Agency->find('list', limit: 200)->all();
        $this->set(compact('shipment', 'shipper', 'consignee', 'carrier', 'agency'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shipment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shipment = $this->Shipments->get($id);
        if ($this->Shipments->delete($shipment)) {
            $this->Flash->success(__('The shipment has been deleted.'));
        } else {
            $this->Flash->error(__('The shipment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
