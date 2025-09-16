<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController as BaseController;
use Cake\Http\Exception\ForbiddenException;

class AppController extends BaseController
{
    public function initialize(): void
    {
        parent::initialize();
	    $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // Kita tidak pakai per-action authorize di admin (cukup gate di sini)
        $this->Authorization->skipAuthorization();

        // Wajib login
        $identity = $this->request->getAttribute('identity');
        if (!$identity) {
            return $this->redirect('/login');
        }

        // Muat user + groups
        $Users = $this->fetchTable('Users'); // <-- ganti dari 'CakeDC/Users.Users'
		$user  = $Users->get($identity->get('id'), ['contain' => ['Groups']]);


        // Ambil nama groups (tanpa arrow function)
        $groupNames = [];
        if (!empty($user->groups)) {
            foreach ($user->groups as $g) {
                $groupNames[] = $g->name;
            }
        }

        $isAdmin = $identity->get('is_superuser') || in_array('admin', $groupNames, true);
        if (!$isAdmin) {
            throw new ForbiddenException('Anda tidak punya akses ke area admin.');
        }

        $this->set('AuthUser', $user);
    }
}
