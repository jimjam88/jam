<?php

namespace Jam\Common\Mvc\Module;

use Phalcon\Mvc\Url;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\Autoloader;
use Doctrine\Common\Proxy\AbstractProxyFactory;
use Jam\Common\Mvc\View;
use Jam\Common\Database\NullCacheDriver;

abstract class ModuleAbstract implements ModuleDefinitionInterface
{
    /**
     * Register the module
     *
     * @param DiInterface $di The DI
     */
    abstract public function register($di);

    /**
     * @{inheritDoc}
     */
    public function registerAutoloaders()
    {
        // We've already defined out autoloader(s)
    }

    /**
     * @{inheritDoc}
     */
    public function registerServices($di)
    {
        $this->registerDatabase($di);
        $this->register($di);
    }

    /**
     * Register the database handler
     *
     * @param  DiInterface $di The DI
     * @return void
     */
    private function registerDatabase($di)
    {
        $modules = $di->getConfig()->get('modules');
        $class = get_class($this);

        foreach ($modules as $module) {
            if ($module->get('className') === $class) {
                if ($module->get('db')) {
                    $this->registerEntityManager($di);
                    break;
                }
            }
        }
    }

    /**
     * Register the entity manager
     *
     * @param  DiInterface $di The DI
     */
    private function registerEntityManager($di)
    {
        $config = $di->getConfig()->get('db');

        $di->set('entity-manager', function() use ($config, $di) {
            $paths = [
                $config->get('paths')->get('entity'),
                $config->get('paths')->get('repository')
            ];

            $databaseCredentials = [
                'driver'   => 'pdo_mysql',
                'host'     => $config->get('host'),
                'user'     => $config->get('user'),
                'password' => $config->get('password'),
                'dbname'   => $config->get('dbname'),
            ];

            $meta = Setup::createAnnotationMetadataConfiguration(
                $paths,
                true,
                $di->getService('path')->getDefinition() . '/' . $config->get('paths')->get('proxy'),
                new NullCacheDriver(),
                false
            );

            $namespace = 'Jam\Common\Database\Proxy';

            $meta->setAutoGenerateProxyClasses(AbstractProxyFactory::AUTOGENERATE_NEVER);
            $meta->setProxyNamespace($namespace);

            Autoloader::register(
                $di->getService('path')->getDefinition() . '/' . $config->get('paths')->get('proxy'),
                $namespace
            );

            return EntityManager::create($databaseCredentials, $meta);
        });
    }
}
