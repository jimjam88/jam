<?php

namespace Jam\Common\Mvc\Controller;

use Phalcon\Mvc\Dispatcher;
use Jam\Common\Auth\Authenticator;
use Jam\Common\Mvc\Controller\RedispatchController;
use Jam\Common\Database\Entity\Admin\UserRole;

abstract class AuthControllerAbstract extends RedispatchController
{
    /**
     * Before executing the route ensure we have a session. If not boot the user
     *
     * @param  Dispatcher $dispatcher The dispacther
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $di = $this->getDI();

        // Authenticate the session
        $result = (new Authenticator($di))->authenticate();

        // Boot the user if the session is invalid
        if (!$result) {
            $this->session->destroy();
            $this->session->start();
            $this->flashSession->error('Your session has expired. Please login');
            $this->response->redirect($di->getUrl()->getBaseUri() . '/login', true, 403);

            return $this->response->send();
        }

        // Check the user is allowed to access this route
        if (!$this->getRoute()->isAllowed($di->get('user')->getRole()->getId())) {
            $this->response->redirect($di->getUrl()->getBaseUri() . '/404', true, 403);
            return $this->response->send();
        }

        // Define view properties
        $this->view->sessionUser = $user = $di->get('user');
        $this->view->isAdmin = $user->getRole()->getId() <= UserRole::ADMIN;
    }

    /**
     * Current route getter.
     *
     * @return Route
     */
    protected function getRoute()
    {
        return $this->router->getMatchedRoute();
    }
}
