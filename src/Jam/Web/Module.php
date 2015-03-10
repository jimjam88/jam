<?php

namespace Jam\Web;

use Phalcon\Mvc\Url;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Jam\Common\Mvc\View;
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
            $dispatcher->setDefaultNamespace('Jam\Web\Controller');
            return $dispatcher;
        });

        $di->set('url', function () {
            $url = new Url();
            $url->setBaseUri('/');
            return $url;
        }, true);

        $di->setShared('view', function() use ($di) {
            return new View($di, __DIR__ . '/views/');
        });
    }
}
