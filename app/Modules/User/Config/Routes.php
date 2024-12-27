<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\User\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('/dashboard', 'User::index');
});
