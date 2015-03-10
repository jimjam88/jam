<?php

namespace Jam\Common;

use LogicException;
use Phalcon\Loader;
// use Phalcon\Mvc\Router;
use Jam\Common\Mvc\Router\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as PhalconApplication;

class Application extends PhalconApplication
{
    /**
     * Constructor
     *
     * @param string $path The base path
     */
    public function __construct($path)
    {
        // Register the autoloader
        $this->registerAutoloader($path);

        // Prepare the DI
        $di = $this->prepareDependancyInjector($path);

        // Get the modules required from config
        $modules = $di->getConfig()->get('modules')->toArray();

        // Register the modules
        $this->registerModules($modules);

        // Register the routes
        $this->registerRoutes($modules);
    }

    /**
     * Register the autoloader(s).
     *
     * @param  string $path The base path
     * @return void
     */
    public function registerAutoloader($path)
    {
        // Composer
        if (!file_exists($composer = $path . '/vendor/autoload.php')) {
            throw new LogicException(
                'Unable to find composer autoloader. Did you run `composer install`?');
        }

        require_once $composer;

        // Phalcon
        $loader = new Loader();
        $loader->registerNamespaces([
            'Jam' => $path . '/src/Jam/',
        ]);
        $loader->register();
    }

    /**
     * Register the DI.
     *
     * @param  string $path The base path
     * @return void
     */
    public function prepareDependancyInjector($path)
    {
        $di = new FactoryDefault();
        $di->set('path', $path);
        $di->set('config', $this->getConfig($path), true);

        $this->setDI($di);

        return $di;
    }

    /**
     * Router getter.
     *
     * @return Router
     */
    public function getRouter()
    {
        $router = new Router(false);
        $router->notFound([
            'module'     => 'web',
            'controller' => 'error',
            'action'     => 'notFound'
        ]);

        return $router;
    }

    /**
     * Register the routes
     *
     * @param  array  $modules The modules
     * @return void
     */
    protected function registerRoutes(array $modules)
    {
        $router = $this->getRouter();

        foreach ($modules as $module) {

            $path = str_replace('Module.php', 'routes.php', $module['path']);

            if (!file_exists($path)) {
                throw new LogicException(sprintf(
                    'Module %s does not have a routes file!', $module['className']));
            }

            require_once $path;
        }

        $this->getDI()->set('router', $router);
    }

    /**
     * Get the config
     *
     * @param  string $path The base path
     * @return void
     */
    public function getConfig($path)
    {
        if (!file_exists($config = $path . '/config/config.php')) {
             throw new LogicException(
                'Unable to find the application config. Did you run `phing`?');
        }

        return require $config;
    }

    /**
     * Run the application.
     *
     * @return string
     */
    public function run()
    {
        try {
            return $this->handle()->getContent();

        } catch (\Exception $e) {
            var_dump($e);
            die;
        }
    }
}
