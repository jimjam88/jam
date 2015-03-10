<?php

namespace Jam\Common\Auth;

use DateTime;
use InvalidArgumentException;
use Jam\Common\Injector\InjectorAbstract;
use Jam\Common\Database\Entity\Admin\User;

class ForgottenPassword extends InjectorAbstract
{
    /**
     * Run the forgotten password manager
     *
     * @param  array  $data The input data
     * @return boolean
     */
    public function run(array $data)
    {
        // Validate the input data
        $this->validate($data);

        // Fetch the user entity
        $user = $this->getUser($data);

        // Send the email


        var_dump($user);die;
    }

    /**
     * Validate the form data
     *
     * @param  array  $data The subject
     * @return void
     */
    protected function validate(array $data)
    {
        if (!array_key_exists('email', $data) || !strlen($data['email'])) {
            throw new InvalidArgumentException('Invalid email address!');
        }

        if (!array_key_exists('lastName', $data) || !strlen($data['lastName'])) {
            throw new InvalidArgumentException('Invalid lastName address!');
        }
    }

    /**
     * User entity getter
     *
     * @param  array  $data The dataset
     * @return User
     */
    protected function getUser(array $data)
    {
        return $this->getDI()
            ->get('entity-manager')
            ->getRepository(User::class)
            ->getUserByEmailAndLastName($data['email'], $data['lastName']);
    }
}
