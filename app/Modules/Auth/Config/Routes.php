<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Auth\Controllers'], function ($routes) {
  $routes->get('/login', 'Auth::index');
  $routes->post('/login', 'AuthController::login'); // ketika form dikirim
  $routes->get('/logout', 'AuthController::logout');
});
