<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// routing untuk Auth
$routes->group('', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
  $routes->get('/login', 'Auth::index');
  $routes->post('/login', 'AuthController::login'); // ketika form dikirim
});

// routing untuk User
$routes->group('', ['namespace' => 'Modules\User\Controllers'], function ($routes) {
  $routes->get('/dashboard', 'User::index');
});
