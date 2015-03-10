<?php

namespace Jam\Admin\Controller;

use Jam\Common\Database\Entity\Contact;
use Jam\Common\Database\Entity\SocialMedia;
use Jam\Common\Mvc\Controller\AuthControllerAbstract;

class SettingsController extends AuthControllerAbstract
{
    public function indexAction()
    {
        $em = $this->getDI()->get('entity-manager');

        $this->view->contact = $em->getRepository(Contact::class)->getContact();
        $this->view->medias = $em->getRepository(SocialMedia::class)->getUrls();
    }

    public function contactAction()
    {
        $di = $this->getDI();

        $contact = $di->get('entity-manager')
                      ->getRepository(Contact::class)
                      ->update($this->request->getPost());

        $this->flashSession->success('Contact details updated successfully');
        $this->response->redirect('/settings');
    }


    public function socialAction()
    {
        $di = $this->getDI();

        $medias = $di->get('entity-manager')
                     ->getRepository(SocialMedia::class)
                     ->update($this->request->getPost());

        $this->flashSession->success('Socials medias updated successfully');
        $this->response->redirect('/settings');
    }
}
