<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\Administrator\Controllers', 'filter' => 'auth'], function ($routes) {});
