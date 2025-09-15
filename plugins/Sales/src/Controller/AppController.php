<?php
declare(strict_types=1);
namespace Sales\Controller;
use App\Controller\AppController as BaseAppController;
class AppController extends BaseAppController
{
    public function initialize(): void
    {
        parent::initialize();
        // $this->viewBuilder()->setLayout('adminlte');
    }
}
