<?php

namespace Jam\Common\Database\Repository\Admin;

use DateTime;
use InvalidArgumentException;
use Phalcon\Security;
use Doctrine\ORM\EntityRepository;
use Jam\Common\Database\Entity\Admin\User;
use Jam\Common\Database\Entity\Admin\UserRole;

class UserRepository extends EntityRepository
{
    /**
     * Persist a user entity
     *
     * @param User $user The entity
     */
    public function persist(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Save a user entity
     *
     * @param User $user The entity
     */
    public function save(User $user)
    {
        $this->_em->merge($user);
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Get all users
     *
     * @return mixed[]
     */
    public function getUsers()
    {
        $qb = $this->createQueryBuilder('User');
        $qb->select('User, UserRole');
        $qb->leftJoin('User.role', 'UserRole');
        $qb->orderBy('User.firstName', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Get a user given an ID
     *
     * @param  integer $id The ID
     * @return User
     */
    public function getUserById($id)
    {
        $qb = $this->createQueryBuilder('User');
        $qb->select('User, UserRole');
        $qb->leftJoin('User.role', 'UserRole');
        $qb->where('User.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Get a user given an email address and a last name
     *
     * @param  string $email    The email address
     * @param  string $lastName The last name
     * @return User
     */
    public function getUserByEmailAndLastName($email, $lastName)
    {
        $qb = $this->createQueryBuilder('User');
        $qb->select('User');
        $qb->where('User.email = :email');
        $qb->andWhere('User.lastName = :lastName');
        $qb->setParameter('email', $email);
        $qb->setParameter('lastName', $lastName);

        return $qb->getQuery()->getSingleResult();
    }


    /**
     * Delete a user.
     *
     * @param  integer $id The user ID
     * @return void
     */
    public function delete($id)
    {
        $this->_em->remove($this->getUserById($id));
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Update a user.
     *
     * @param  integer $id  The user ID
     * @param  array  $data The update data
     * @return User
     */
    public function update($id, array $data)
    {
        $user = $this->getUserById($id);

        if (array_key_exists('firstName', $data)
            && strlen($data['firstName'])
            && $data['firstName'] !== $user->getFirstName()
        ) {
            $user->setFirstName($data['firstName']);
        }

        if (array_key_exists('lastName', $data)
            && strlen($data['lastName'])
            && $data['lastName'] !== $user->getLastName()
        ) {
            $user->setLastName($data['lastName']);
        }

        if (array_key_exists('email', $data)
            && strlen($data['email'])
            && $data['email'] !== $user->getEmail()
        ) {
            $user->setEmail($data['email']);
        }

        if (array_key_exists('role', $data)
            && is_numeric($data['role'])
            && $data['role'] != $user->getRole()->getId()
        ) {
            $role = $this->_em->getRepository(UserRole::class)->findOneBy(['id' => $data['role']]);

            $user->setRole($role);
        }

        $user->setDateUpdated(new DateTime());
        $this->save($user);

        return $user;
    }

    /**
     * Add a new user
     *
     * @param array    $data     The user data
     * @param Security $security Security helper
     */
    public function add(array $data, Security $security)
    {
        if (!array_key_exists('firstName', $data) || !strlen($data['firstName'])) {
            throw new InvalidArgumentException('You must provide a first name!');
        }

        if (!array_key_exists('lastName', $data) || !strlen($data['lastName'])) {
            throw new InvalidArgumentException('You must provide a last name!');
        }

        if (!array_key_exists('email', $data) || !strlen($data['email'])) {
            throw new InvalidArgumentException('You must provide an email address!');
        }

        if (!array_key_exists('role', $data) || !strlen($data['role'])) {
            throw new InvalidArgumentException('You must provide a role!');
        }

        if (!array_key_exists('password', $data) || !strlen($data['password'])) {
            throw new InvalidArgumentException('You must provide a password!');
        }

        if (!array_key_exists('confirmPassword', $data) || !strlen($data['confirmPassword'])) {
            throw new InvalidArgumentException('The password was not confirmed! Please try again');
        }

        if ($data['password'] !== $data['confirmPassword']) {
            throw new InvalidArgumentException('Passwords do not match!');
        }

        if (strlen($data['password']) < 6) {
            throw new InvalidArgumentException('Password must be more than 6 characters long!');
        }

        $user = new User();
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setEmail($data['email']);
        $user->setPassword($security->hash($data['password']));

        $role = $this->_em->getRepository(UserRole::class)->findOneBy(['id' => $data['role']]);
        $user->setRole($role);

        $this->persist($user);
    }

    /**
     * Change a user's password.
     *
     * @param  integer $id   The user ID
     * @param  array   $data The request data
     * @return User
     */
    public function changePassword($id, array $data, Security $security)
    {
        // foreach ($data as &$item) {
        //     $item = $security->hash($item);
        // }

        $user = $this->getUserById($id);

        if (!$security->checkHash($data['oldPassword'], $user->getPassword())) {
            throw new InvalidArgumentException('Incorrect current password!');
        }

        if (strlen($data['newPassword']) < 6) {
            throw new InvalidArgumentException('New password must be more than 6 characters long!');
        }

        if ($data['newPassword'] !== $data['confirmPassword']) {
            throw new InvalidArgumentException('New passwords do not match!');
        }

        $user->setPassword($security->hash($data['newPassword']));
        $user->setDateUpdated(new DateTime());
        $this->save($user);

        return $user;
    }
}
