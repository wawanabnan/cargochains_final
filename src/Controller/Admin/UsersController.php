<?php
declare(strict_types=1);

namespace App\Controller\Admin;

class UsersController extends AppController
{
    protected $modelClass = 'Users';

    public function index()
    {
        $q = $this->Users->find()->contain(['Groups'])->order(['Users.created' => 'DESC']);
        $users = $this->paginate($q, ['limit' => 20]);
        $this->set(compact('users'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id, ['contain' => ['Groups']]);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        $Groups = $this->fetchTable('Groups');
        $groupsList = $Groups->find('list')->orderAsc('name')->toArray();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data, ['associated' => ['Groups']]);

            if ($this->Users->save($user)) {
                $this->Flash->success('User created.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Failed to create user. Please fix the errors.');
        }

        $this->set(compact('user', 'groupsList'));
    }

    public function edit($id)
    {
        $user = $this->Users->get($id, ['contain' => ['Groups']]);

        $Groups = $this->fetchTable('Groups');
        $groupsList = $Groups->find('list')->orderAsc('name')->toArray();

        if ($this->request->is(['patch','post','put'])) {
            $data = $this->request->getData();
            if (empty($data['password'])) {
                unset($data['password']); // jangan ubah password kalau kosong
            }
            $user = $this->Users->patchEntity($user, $data, ['associated' => ['Groups']]);

            if ($this->Users->save($user)) {
                $this->Flash->success('User updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Failed to update user.');
        }

        $this->set(compact('user', 'groupsList'));
    }
}
