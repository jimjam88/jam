<?php

namespace Jam\Admin\Controller;

use StdClass;
use InvalidArgumentException;
use Doctrine\ORM\Query;
use Doctrine\ORM\NoResultException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Jam\Common\Mvc\Controller\AuthControllerAbstract;
use Jam\Common\Database\Entity\Admin\User;
use Jam\Common\Database\Entity\Admin\UserRole;

class UsersController extends AuthControllerAbstract
{
    /**
     * User index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->view->users = $this->getDI()
             ->get('entity-manager')
             ->getRepository(User::class)
             ->getUsers();
    }

    /**
     * Add user action
     *
     * @return void
     */
    public function addAction()
    {
        $di = $this->getDI();
        $em = $di->get('entity-manager');

        $this->view->data = [
            'firstName' => null,
            'lastName'  => null,
            'email'     => null,
            'role'      => null,
        ];

        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            try {
                $em->getRepository(User::class)->add($post, $di->getSecurity());

                $this->flashSession->success(
                    $post['firstName'] . ' ' . $post['lastName'] . ' added successfully');

            } catch (InvalidArgumentException $e) {
                $this->flashSession->error($e->getMessage());
                $this->view->data = $post;

           } catch (UniqueConstraintViolationException $e) {
                $this->flashSession->error('User already exists!');
           }
        }

        $this->view->roles = $em
             ->getRepository(UserRole::class)
             ->findAll();
    }

    /**
     * View user action
     *
     * @param  integer $id
     * @return void
     */
    public function viewAction($id)
    {
        $em = $this->getDI()->get('entity-manager');

        try {
            $this->view->details = $em
                 ->getRepository(User::class)
                 ->getUserById($id);

             $this->view->roles = $em
                 ->getRepository(UserRole::class)
                 ->findAll();

        } catch (NoResultException $e) {
            return $this->response->writeNotFound();
        }
    }

    /**
     * Edit user action
     *
     * @param  integer $id
     * @return void
     */
    public function editAction($id)
    {
        $this->getDI()
             ->get('entity-manager')
             ->getRepository(User::class)
             ->update($id, $this->request->getPost());

        $this->flashSession->success('User updated successfully');

        $this->response->redirect('/users/' . $id);
    }

    /**
     * Delete user action
     *
     * @param  integer $id
     * @return void
     */
    public function deleteAction($id)
    {
        $this->getDI()
             ->get('entity-manager')
             ->getRepository(User::class)
             ->delete($id);

        $this->flashSession->success('User deleted successfully');

        $this->response->redirect('/users');
    }
}
