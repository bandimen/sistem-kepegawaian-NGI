<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\User\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('/dashboard', 'User::index');
  $routes->get('/form-lembur', 'User::show_form_lembur');
  $routes->get('/form-cuti', 'User::show_form_cuti');
  $routes->get('/form-dinas-luar', 'User::show_form_dinas_luar');
  $routes->get('/form-peminjaman-karyawan', 'User::show_form_peminjaman_karyawan');
  $routes->get('/form-slip-gaji', 'User::show_form_slip_gaji');

});
