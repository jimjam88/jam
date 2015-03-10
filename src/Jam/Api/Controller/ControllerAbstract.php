<?php

namespace Jam\Api\Controller;

use Phalcon\Mvc\Controller;

abstract class ControllerAbstract extends Controller
{
    /**
     * After execute route
     *
     * @return void
     */
    public function afterExecuteRoute()
    {
        $this->response->send();
    }
}
