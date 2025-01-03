<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\ManajemenData\Controllers'], function ($routes) {
  $routes->get('manajemen-provinsi', 'ManajemenData::show_manajemen_provinsi');
  $routes->get('manajemen-kota', 'ManajemenData::show_manajemen_kota');
  $routes->get('data-jabatan', 'ManajemenData::show_data_jabatan');
  $routes->get('data-unit-kerja', 'ManajemenData::show_data_unit_kerja');
});
