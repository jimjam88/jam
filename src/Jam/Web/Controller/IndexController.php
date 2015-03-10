<?php

namespace Jam\Web\Controller;

use Jam\Common\Mvc\Controller\RedispatchController;
use Jam\Api\Controller\IndexController as ApiIndexController;

class IndexController extends RedispatchController
{
    public function indexAction()
    {
        $this->view->test = $this->redispatch(ApiIndexController::class, 'index', []);
    }
}
