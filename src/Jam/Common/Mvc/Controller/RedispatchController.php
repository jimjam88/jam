<?php

namespace Jam\Common\Mvc\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Jam\Common\Mvc\FauxResponse;

abstract class RedispatchController extends Controller
{
    /**
     * Perform a redispatch to another controller.
     *
     * This method works accross all modules. This method will stop internal
     * HTTP request (e.g API calls).
     *
     * @example $this->redispatch(ApiIndexController::class, 'index', []);
     * @param   string $controller The controller to dispatch to (full namespace)
     * @param   string $action     The controller action to execute
     * @param   array  $params     Action parameters
     * @return  mixed
     */
    protected function redispatch($controller, $action, array $params = [])
    {
        $controller = preg_replace('/Controller$/', '', $controller);

        // Clone the DI
        $di = clone $this->getDI();

        // Create a fake response object to store the response from the method
        // that we're redispatching to
        $response = new FauxResponse();
        $response->setDI($di);
        $di->set('response', $response);

        // Create a new dispatcher and execute it
        $d = new Dispatcher();
        $d->setDI($di);
        $d->setControllerName($controller);
        $d->setActionName($action);
        $d->setParams($params);
        $d->dispatch();

        return $response->getContent();
    }
}
