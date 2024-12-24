<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('auth', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
  $routes->get('/', 'Auth::index'); // Akses ke Auth module
  $routes->get('login', 'Auth::login'); // Contoh rute lain
});
