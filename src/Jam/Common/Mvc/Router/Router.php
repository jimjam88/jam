<?php

namespace Jam\Common\Mvc\Router;

use Phalcon\Mvc\Router as PhalconRouter;
use Phalcon\Mvc\Router\Group;
use Jam\Common\Mvc\Router\Route;

class Router extends PhalconRouter
{
    /**
     * Add a route
     *
     * @param string          $pattern The pattern
     * @param string|string[] $paths   The paths
     * @param string|null     $methods The HTTP methods
     */
    public function add($pattern, $paths = null, $methods = null)
    {
        return $this->_routes[] = new Route($pattern, $paths, $methods);
    }
}
