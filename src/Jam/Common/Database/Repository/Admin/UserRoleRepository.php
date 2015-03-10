<?php

namespace Jam\Common\Database\Repository\Admin;

use Doctrine\ORM\EntityRepository;
use Jam\Common\Database\Entity\Admin\UserRole;

class UserRoleRepository extends EntityRepository
{
    /**
     * Save a user entity
     *
     * @param UserRole $user The entity
     */
    public function save(UserRole $user)
    {
        $this->_em->merge($user);
        $this->_em->flush();
        $this->_em->clear();
    }
}
