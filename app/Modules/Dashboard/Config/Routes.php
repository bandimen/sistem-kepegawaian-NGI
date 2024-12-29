<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Dashboard\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('/dashboard', 'Dashboard::index');
  $routes->get('/profil', 'Dashboard::show_profil');
});
