<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Administrator\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('manajemen-user', 'Administrator::show_manajemen_user');
  $routes->get('manajemen-jenis-user', 'Administrator::show_manajemen_jenis_user');
});
