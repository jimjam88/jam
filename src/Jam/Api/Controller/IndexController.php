<?php

namespace Jam\Api\Controller;

use Jam\Api\Controller\ControllerAbstract;
use Jam\Api\Model\Details;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->response->setJsonContent(
            Details::get($this->getDI()->get('entity-manager')),
            JSON_NUMERIC_CHECK
        );
    }
}
