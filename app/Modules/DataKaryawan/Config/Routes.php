<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\DataKaryawan\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('/data-karyawan', 'DataKaryawan::show_data_karyawan');
  $routes->post('/data-karyawan/ajaxKota', 'TambahDataKaryawan::ajaxKotaDropdown');
  $routes->post('/data-karyawan/tambah', 'TambahDataKaryawan::tambah');
});