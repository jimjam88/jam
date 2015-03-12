<?php

namespace Jam\Admin\Controller;

use Jam\Api\Controller\IndexController as ApiIndexController;
use Jam\Common\Mvc\Controller\AuthControllerAbstract;

class ApiController extends AuthControllerAbstract
{
    public function indexAction()
    {
    }

    public function detailsAction()
    {
        $this->view->details = json_encode($this->redispatch(
            ApiIndexController::class, 'details'
        ), JSON_PRETTY_PRINT);
    }
}
