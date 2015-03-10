<?php

namespace Jam\Admin\Controller;

use Exception;
use InvalidArgumentException;
use Doctrine\ORM\NoResultException;
use Jam\Common\Auth\Authenticator;
use Jam\Common\Auth\ForgottenPassword;
use Jam\Common\Mvc\Controller\RedispatchController;

class AuthController extends RedispatchController
{
    /**
     * Login action.
     *
     * @return void
     */
    public function loginAction()
    {
        $this->view->title = 'Please Login';

        if ($this->request->isPost() && $this->security->checkToken()) {
            try {
                // Attempt the login
                (new Authenticator($this->getDI()))->check($this->request->getPost());

                // Redirect to the index of the module
                $this->response->redirect('');

            // Catch ALL exceptions
            } catch (Exception $e) {
                $this->session->start();
                $this->flashSession->error('Incorrect email or password. Please try again');
            }
        }
    }

    /**
     * Logout a user
     *
     * @return void
     */
    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('/login');
    }

    /**
     * Forgotten password
     *
     * @return void
     */
    public function forgottenPasswordAction()
    {
        return $this->response->redirect('/404');

        // if ($this->request->isPost() && $this->security->checkToken()) {
        //     try {
        //         $service = new ForgottenPassword($this->getDI());
        //         $service->run($this->request->getPost());

        //     } catch (InvalidArgumentException $e) {
        //         $this->flashSession->error($e->getMessage());

        //     } catch (NoResultException $e) {
        //         $this->flashSession->error(
        //             'We couldn\'t find an account with the details you provided. Please try again');
        //     }
        // }
    }
}
