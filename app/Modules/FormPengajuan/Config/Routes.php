<?php

if (!isset($routes)) {
  $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Modules\FormPengajuan\Controllers', 'filter' => 'auth'], function ($routes) {
  $routes->get('/form-lembur', 'FormPengajuan::show_form_lembur');
  $routes->get('/form-cuti', 'FormPengajuan::show_form_cuti');
  $routes->get('/form-dinas-luar', 'FormPengajuan::show_form_dinas_luar');
  $routes->get('/form-peminjaman-karyawan', 'FormPengajuan::show_form_peminjaman_karyawan');
  $routes->get('/form-slip-gaji', 'FormPengajuan::show_form_slip_gaji');
});
