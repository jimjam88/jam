<?php

namespace Jam\Common\Mvc\Router;

use Phalcon\Mvc\Router\Group as PhalconGroup;

class Group extends PhalconGroup
{
    /**
     * Add a route to the group
     *
     * @param string          $pattern The pattern
     * @param string|string[] $paths   The paths
     * @param string          $methods The HTTP method
     */
    public function _addRoute($pattern, $paths = null, $methods = null)
    {
        $pattern = $this->_prefix . $pattern;
        $paths = array_merge($this->_paths, $paths);

        $route = new Route($pattern, $paths, $methods);
        $route->setGroup($this);

        $this->_routes[] = $route;

        return $route;
    }
}
