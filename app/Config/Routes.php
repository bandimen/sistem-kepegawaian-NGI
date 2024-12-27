<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// Routing untuk Auth
$routes->group('', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
  $routes->get('/login', 'Auth::index');
  $routes->post('/login', 'AuthController::login'); // ketika form dikirim
  $routes->get('/logout', 'AuthController::logout');
});

// Routing untuk User dengan filter auth
$routes->group('', ['namespace' => 'Modules\User\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('/dashboard', 'User::index');
  $routes->get('/form-elements', 'User::show_form_elements');
});