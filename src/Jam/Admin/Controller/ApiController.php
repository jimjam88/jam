<?php

namespace Jam\Admin\Controller;

use Jam\Api\Controller\IndexController as ApiIndexController;
use Jam\Common\Mvc\Controller\AuthControllerAbstract;

class ApiController extends AuthControllerAbstract
{
    public function indexAction()
    {
        $this->view->details = $this->redispatch(ApiIndexController::class, 'index');
    }
}
