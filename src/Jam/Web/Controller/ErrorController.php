<?php

namespace Jam\Web\Controller;

use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
    }
}
