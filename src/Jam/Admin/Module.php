<?php

namespace Jam\Admin;

use Phalcon\Mvc\Url;
use Phalcon\Security;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Session\Adapter\Files;
use Phalcon\Flash\Session as Flash;
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
            $dispatcher->setDefaultNamespace('Jam\Admin\Controller');
            return $dispatcher;
        });

        $di->set('url', function () {
            $url = new Url();
            $url->setBaseUri('/admin');
            return $url;
        }, true);

        $di->set('view', function() use ($di) {
            return new View($di, __DIR__ . '/views/');
        });

        $di->setShared('session', function() {
            $session = new Files();
            $session->start();
            return $session;
        });

        $di->set('flashSession', function() {
            $flash = new Flash();
            $flash->setAutomaticHtml(false);

            return $flash;
        });

        $di->setShared('security', function(){
            $security = new Security();
            $security->setWorkFactor(12);

            return $security;
        });
    }
}
