<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Jam/Common/Database/NullCacheDriver.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Jam\Common\Database\NullCacheDriver;

$databaseCredentials = [
    'driver'   => 'pdo_mysql',
    'host'     => '%%db.hostname%%',
    'user'     => '%%db.username%%',
    'password' => '%%db.password%%',
    'dbname'   => '%%db.dbname%%',
];

$paths = [__DIR__ . '/../%%db.paths.entity%%', __DIR__ . '/../%%db.paths.repository%%'];

$doctrineConfig = Setup::createAnnotationMetadataConfiguration($paths, false, __DIR__ . '/../%%db.paths.proxy%%', new NullCacheDriver(), false);
$doctrineConfig->setProxyNamespace('Jam\Common\Database\Proxy');

$entityManager  = EntityManager::create($databaseCredentials, $doctrineConfig);

return ConsoleRunner::createHelperSet($entityManager);
