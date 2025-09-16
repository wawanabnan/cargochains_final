<?php
declare(strict_types=1);

namespace App\Controller\Admin;

class GroupsController extends AppController
{
    protected $modelClass = 'Groups'; // model App

    public function index()
    {
        $groups = $this->paginate($this->Groups->find()->orderAsc('name'));
        $this->set(compact('groups'));
    }

    public function add()
    {
        $group = $this->Groups->newEmptyEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success('Group created.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Failed to create group.');
        }
        $this->set(compact('group'));
    }

    public function edit($id)
    {
        $group = $this->Groups->get($id);
        if ($this->request->is(['patch','post','put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success('Group updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Failed to update group.');
        }
        $this->set(compact('group'));
    }
}
