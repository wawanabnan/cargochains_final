<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

		$this->viewBuilder()->setLayout('adminlte'); // pakai layout adminlte
        $this->loadComponent('Flash');

        // Auth components
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $plugin     = (string)$this->request->getParam('plugin');
        $controller = (string)$this->request->getParam('controller');
        $action     = (string)$this->request->getParam('action');

        // Skip Authorization untuk route publik CakeDC Users
        if ($plugin === 'CakeDC/Users' && $controller === 'Users' && in_array($action, [
            'login', 'logout', 'register',
            'requestResetPassword', 'resetPassword',
            'verify', 'socialLogin', 'socialEmail',
            'linkSocial', 'callbackLinkSocial'
        ], true)) {
            $this->Authorization->skipAuthorization();
            return;
        }

        // Halaman Pages bawaan (opsional)
        if ($controller === 'Pages' && $action === 'display') {
            $this->Authorization->skipAuthorization();
            return;
        }
    }
}
