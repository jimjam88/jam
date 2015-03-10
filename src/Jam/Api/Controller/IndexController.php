<?php

namespace Jam\Api\Controller;

use Jam\Api\Controller\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->response->setJsonContent(["testing" => 123], JSON_NUMERIC_CHECK);
    }
}
