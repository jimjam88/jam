<?php

use Phalcon\Config;
use Jam\Admin\Module as AdminModule;
use Jam\Api\Module as ApiModule;
use Jam\Web\Module as WebModule;

return new Config([

    // Doctrine configuration
    'db' => [
        'host'     => '%%db.hostname%%',
        'user'     => '%%db.username%%',
        'password' => '%%db.password%%',
        'dbname'   => '%%db.dbname%%',
        'paths'    => [
            'entity'     => '%%db.paths.entity%%',
            'repository' => '%%db.paths.repository%%',
            'proxy'      => '%%db.paths.proxy%%',
        ],
    ],

    // Register the required modules for the application here.
    'modules' => [
        'api' => [
            'className' => ApiModule::class,
            'path'      => realpath(__DIR__ . '/../src/Jam/Api/Module.php'),
            'db'        => true,
        ],
        'web' => [
            'className' => WebModule::class,
            'path'      => realpath(__DIR__ . '/../src/Jam/Web/Module.php'),
            'db'        => true,
        ],
        'admin' => [
            'className' => AdminModule::class,
            'path'      => realpath(__DIR__ . '/../src/Jam/Admin/Module.php'),
            'db'        => true,
        ],
    ],

    // Module specific configuration
    'web' => [],
    'api' => [],
    'admin' => [],
]);
