<?php

$router->add('/', [
    'module'     => 'web',
    'controller' => 'index',
    'action'     => 'index',
]);

$router->add('/contact', [
    'module'     => 'web',
    'controller' => 'contact',
    'action'     => 'index',
]);

