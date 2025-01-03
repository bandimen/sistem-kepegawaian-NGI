<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\ManajemenData\Controllers'], function ($routes) {
  $routes->get('data-provinsi', 'ManajemenData::show_data_provinsi');
  $routes->get('data-kota', 'ManajemenData::show_data_kota');
  $routes->get('data-jabatan', 'ManajemenData::show_data_jabatan');
  $routes->post('data-jabatan/tambah', 'JabatanController::tambah');
  $routes->post('data-jabatan/delete', 'JabatanController::delete');

  $routes->get('data-unit-kerja', 'ManajemenData::show_data_unit_kerja');
  $routes->get('data-status-kontrak', 'ManajemenData::show_data_status_kontrak');
});
