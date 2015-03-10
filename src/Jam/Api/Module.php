<?php

namespace Jam\Api;

use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Response;
use Jam\Common\Mvc\Module\ModuleAbstract;

class Module extends ModuleAbstract
{
    /**
     * @{inheritDoc}
     */
    public function register($di)
    {
        $di->setShared('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Jam\Api\Controller');
            return $dispatcher;
        });

        $di->set('url', function () {
            $url = new Url();
            $url->setBaseUri('/api');
            return $url;
        }, true);

        $di->setShared('view', function() {
            $view = new View();
            $view->disable();
            return $view;
        });

        $di->set('response', function() {
            $response = new Response();
            $response->setContentType('application/json', 'utf-8');
            return $response;
        });
    }
}
