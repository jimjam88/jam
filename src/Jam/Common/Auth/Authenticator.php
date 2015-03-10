<?php

namespace Jam\Common\Auth;

use DateTime;
use InvalidArgumentException;
use Jam\Common\Injector\InjectorAbstract;
use Jam\Common\Database\Entity\Admin\User;

class Authenticator extends InjectorAbstract
{
    /**
     * Authenticate a session (each request).
     *
     * @return boolean
     */
    public function authenticate()
    {
        $di = $this->getDI();
        $session = $di->get('session');

        // Is there a user in session?
        if (!$session->has('auth')) {
            return false;
        }

        $em = $di->get('entity-manager')->getRepository(User::class);
        $user = $em->findOneBy(['id' => $session->get('auth')]);

        // Is the user a valid entity?
        if (!$user instanceof User) {
            return false;
        }

        // Is there an auth token?
        if (is_null($user->getAuthToken())) {
            return false;
        }

        // Has the auth token expired?
        $expiry = $user->getAuthTokenExpiry();

        if (!$expiry instanceof DateTime || $expiry < new DateTime()) {
            return false;
        }

        // Whoop whoop! This is a valid session
        // Update the auth expiry time
        $user->setAuthTokenExpiry(new DateTime('+1 hour'));
        $em->save($user);

        $di->setShared('user', $user);

        return true;
    }

    /**
     * Check a users details (login).
     *
     * @param  array  $details The details
     * @return void
     */
    public function check(array $details)
    {
        $di = $this->getDI();
        $repo = $di->get('entity-manager')->getRepository(User::class);

        // Fetch the user by email
        $user = $repo->findOneBy(['email' => $details['email']]);

        // Did we find a user?
        if (!$user instanceof User) {
            throw new InvalidArgumentException('Invalid email address');
        }

        $security = $di->getSecurity();

        // Check the password
        if (!$security->checkHash($details['password'], $user->getPassword())) {
            throw new InvalidArgumentException('Invalid password');
        }

        // Generate an authentication token
        $user->setAuthToken($security->getToken());
        $user->setAuthTokenExpiry(new DateTime('+1 hour'));
        $user->setLastLogin(new DateTime());
        $user->incrementLoginCount();
        $repo->save($user);

        $di->getSession()->set('auth', $user->getId());
    }
}
