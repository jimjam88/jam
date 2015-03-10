<?php

use Jam\Common\Mvc\Router\Group;
use Jam\Common\Database\Entity\Admin\UserRole;

// ----------------------------------------------------------------------- Index
$router->addGet('/admin', [
    'module'     => 'admin',
    'controller' => 'index',
    'action'     => 'index',
]);

// ------------------------------------------------------------------------ Auth

$router->add('/admin/login', [
    'module'     => 'admin',
    'controller' => 'auth',
    'action'     => 'login',
]);

$router->add('/admin/logout', [
    'module'     => 'admin',
    'controller' => 'auth',
    'action'     => 'logout',
]);

$router->add('/admin/forgotten-password', [
    'module'     => 'admin',
    'controller' => 'auth',
    'action'     => 'forgottenPassword',
]);

// ----------------------------------------------------------------------- Pages
$router->addGet('/admin/pages', [
    'module'     => 'admin',
    'controller' => 'pages',
    'action'     => 'index',
]);

// ------------------------------------------------------------------------ Blog
$router->addGet('/admin/blog', [
    'module'     => 'admin',
    'controller' => 'blog',
    'action'     => 'index',
]);

// ----------------------------------------------------------------------- Users
$users = new Group([
    'module'     => 'admin',
    'controller' => 'users',
]);

$users->setPrefix('/admin/users');

// Index
$users->addGet('', [
    'action' => 'index',
]);

// View a user
$users->addGet('/{id}', [
    'action' => 'view',
]);

// Edit a user
$users->addPost('/{id}/edit', [
    'action' => 'edit',
])->allow(UserRole::ADMIN);

// Delete a user
$users->addPost('/{id}/delete', [
    'action' => 'delete',
])->allow(UserRole::ADMIN);

// Add a user
$users->add('/add', [
    'action' => 'add',
])->allow(UserRole::ADMIN);

$router->mount($users);

// --------------------------------------------------------------------- Profile
$router->add('/admin/profile/{id}', [
    'module'     => 'admin',
    'controller' => 'profile',
    'action'     => 'index',
]);

$router->addPost('/admin/change-password/{id}', [
    'module'     => 'admin',
    'controller' => 'profile',
    'action'     => 'password',
]);

// -------------------------------------------------------------------- Settings
$router->addGet('/admin/settings', [
    'module'     => 'admin',
    'controller' => 'settings',
    'action'     => 'index',
])->allow(UserRole::ADMIN);

$router->addPost('/admin/settings/contact-details', [
    'module'     => 'admin',
    'controller' => 'settings',
    'action'     => 'contact',
])->allow(UserRole::ADMIN);

$router->addPost('/admin/settings/social-media', [
    'module'     => 'admin',
    'controller' => 'settings',
    'action'     => 'social',
])->allow(UserRole::ADMIN);

// -------------------------------------------------------------------- Settings
$router->addGet('/admin/api', [
    'module'     => 'admin',
    'controller' => 'api',
    'action'     => 'index',
])->allow(UserRole::ADMIN);
