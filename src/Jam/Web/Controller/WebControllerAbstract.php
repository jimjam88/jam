<?php

namespace Jam\Web\Controller;

use Phalcon\Mvc\Dispatcher;
use Jam\Common\Mvc\Controller\RedispatchController;
use Jam\Api\Controller\IndexController as ApiIndexController;

abstract class WebControllerAbstract extends RedispatchController
{
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->view->contact = $this->redispatch(ApiIndexController::class, 'details', []);
    }
}
