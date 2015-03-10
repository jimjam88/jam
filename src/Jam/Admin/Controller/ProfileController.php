<?php

namespace Jam\Admin\Controller;

use InvalidArgumentException;
use Jam\Common\Database\Entity\Admin\User;
use Jam\Common\Mvc\Controller\AuthControllerAbstract;

class ProfileController extends AuthControllerAbstract
{
    /**
     * POST|GET /admin/profile/:id
     */
    public function indexAction($id)
    {
        $di = $this->getDI();
        $user = $di->get('user');

        if ($id != $user->getId()) {
            $this->response->redirect($di->getUrl()->getBaseUri() . '/404', true, 403);
            return $this->response->send();
        }

        if ($this->request->isPost()) {
            try {
                $user = $di
                    ->get('entity-manager')
                    ->getRepository(User::class)
                    ->update($id, $this->request->getPost());

                $di->set('user', $user);

                $this->flashSession->success('Your details have been updated');

            } catch (InvalidArgumentException $e) {
                $this->flashSession->error($e->getMessage());
            }
        }
    }

    /**
     * POST /change-password/:id
     */
    public function passwordAction($id)
    {
        $di = $this->getDI();
        $user = $di->get('user');

        if ($id != $user->getId()) {
            $this->response->redirect($di->getUrl()->getBaseUri() . '/404', true, 403);
            return $this->response->send();
        }

        try {
            $user = $di
                ->get('entity-manager')
                ->getRepository(User::class)
                ->changePassword($id, $this->request->getPost(), $di->get('security'));

            $di->set('user', $user);

            $this->flashSession->success('Your password has been changed');

        } catch (InvalidArgumentException $e) {
            $this->flashSession->error($e->getMessage());
        }

        $this->response->redirect('/profile/' . $id);
    }
}
