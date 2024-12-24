<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('auth', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
  $routes->get('/', 'Auth::index');
  $routes->post('login', 'AuthController::login');
});

$routes->group('user', ['namespace' => 'Modules\User\Controllers'], function ($routes) {
  $routes->get('dashboard', 'User::index');
});
