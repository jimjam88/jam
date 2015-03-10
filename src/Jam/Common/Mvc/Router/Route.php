<?php

namespace Jam\Common\Mvc\Router;

use LogicException;
use Phalcon\Mvc\Router\Route as PhalconRoute;

class Route extends PhalconRoute
{
    /**
     * The roles that are allowed to access this route
     *
     * @var integer[]
     */
    protected $roles = [];

    /**
     * Allow a role to access this route
     *
     * @return self
     */
    public function allow()
    {
        $roles = func_get_args();

        if (count($roles) === 0) {
            throw new LogicException(
                'You must provide at lease one role to allow!');
        }

        $this->roles = $roles;

        return $this;
    }

    /**
     * Is this role allowed to access this route?
     *
     * @param  integer $role The role ID
     * @return boolean
     */
    public function isAllowed($role)
    {
        if (count($this->roles) === 0) {
            return true;
        }

        if ($role <= max($this->roles)) {
            return true;
        }

        return false;
    }

    /**
     * Roles getter.
     *
     * @return integer[]
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
