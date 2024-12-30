<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Kota\Models\KotaModel;
use Modules\Karyawan\Models\KaryawanModel;

class TambahDataKaryawan extends BaseController
{
  protected $folder_directory = "Modules\\DataKaryawan\\Views\\";

  protected $userModel;
  protected $kotaModel;
  protected $karyawanModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->kotaModel = new KotaModel();
    $this->karyawanModel = new KaryawanModel();
  }

  public function ajaxKotaDropdown()
  {
    $kode_prov = $this->request->getVar('kode_prov');
    // ambil semua kota berdasarkan provinsi yg udah dipilih
    $listKota = $this->kotaModel->where('kode_provinsi', $kode_prov)
      ->where('is_deleted', 0);
    // jika diketikkan sesuatu di pencariannya
    if ($this->request->getVar('searchTerm')) {
      $searchTerm = $this->request->getVar('searchTerm');
      $listKota = $listKota->like('nama', $searchTerm);
    }
    $listKota = $listKota->orderBy('nama')->findAll();
    $data = [];
    foreach ($listKota as $kota) {
      $data[] = [
        'id' => $kota['id'],
        'text' => $kota['nama'],
      ];
    }
    $response['data'] = $data;
    return $this->response->setJSON($response);
  }

  public function tambah()
  {
    // entitas yang login
    $sesi = session()->get();
    $userData = $this->userModel->where('id', $sesi['user_id'])->first();

    // field input
    $nama = $this->request->getVar('nama');
    $nip = $this->request->getVar('nip');
    $npwp = $this->request->getVar('npwp');
    $username = $this->request->getVar('username');
    $nik = $this->request->getVar('nik');
    $no_bpjs = $this->request->getVar('no_bpjs');
    $tempat_lahir = $this->request->getVar('tempat_lahir');
    $tanggal_lahir = $this->request->getVar('tanggal_lahir');
    $jenis_kelamin = $this->request->getVar('jenis_kelamin');
    $alamat_ktp = $this->request->getVar('alamat_ktp');
    $alamat_domisili = $this->request->getVar('alamat_domisili');
    $alamat_korespondensi = $this->request->getVar('alamat_korespondensi');
    $kota = $this->request->getVar('kota');
    $unit_kerja = $this->request->getVar('unit_kerja');
    $divisi = $this->request->getVar('divisi');
    $jabatan = $this->request->getVar('jabatan');
    $grade = $this->request->getVar('grade');
    $status_kontrak = $this->request->getVar('status_kontrak');
    $tanggal_masuk = $this->request->getVar('tanggal_masuk');
    $status_pernikahan = $this->request->getVar('status_pernikahan');
    $jml_tanggungan = $this->request->getVar('jml_tanggungan');
    $email_kantor = $this->request->getVar('email_kantor');
    $email_pribadi = $this->request->getVar('email_pribadi');
    $no_telp = $this->request->getVar('no_telp');
    $no_rek = $this->request->getVar('no_rek');
    // $pas_foto = $this->request->getVar('pas_foto');
    // $file_ktp = $this->request->getVar('file_ktp');
    // $file_bpjs = $this->request->getVar('file_bpjs');
    // $file_npwp = $this->request->getVar('file_npwp');
    // $file_kk = $this->request->getVar('file_kk');
    // $file_pendidikan = $this->request->getVar('file_pendidikan');

    // tambah data user baru
    $this->userModel->insert([
      'nama' => $nama,
      'username' => $username,
      'email' => $email_kantor,
      'password' => sha1('ngi123'),
      'divisi_id' => $divisi,
      'created_by' => $userData['nama'],
      'updated_by' => $userData['nama'],
    ]);

    $userId = $this->userModel->insertID();

    // tambah data karyawan baru
    $this->karyawanModel->save([
      'nama' => $nama,
      'nip' => $nip,
      'nik' => $nik,
      'npwp' => $npwp,
      'no_bpjs' => $no_bpjs,
      'jenis_kelamin' => $jenis_kelamin,
      'tempat_lahir' => $tempat_lahir,
      'tanggal_lahir' => $tanggal_lahir,
      'email_kantor' => $email_kantor,
      'email_pribadi' => $email_pribadi,
      'alamat_ktp' => $alamat_ktp,
      'alamat_domisili' => $alamat_domisili,
      'alamat_korespondensi' => $alamat_korespondensi,
      'no_telp' => $no_telp,
      'grade_id' => $grade,
      'status_kontrak_id' => $status_kontrak,
      'status_pernikahan_id' => $status_pernikahan,
      'jml_tanggungan' => $jml_tanggungan,
      'no_rek' => $no_rek,
      'kota_id' => $kota,
      'user_id' => $userId,
      'unit_kerja_id' => $unit_kerja,
      'divisi_id' => $divisi,
      'jabatan_id' => $jabatan,
      'tanggal_masuk' => $tanggal_masuk,
      // 'pas_foto' => $pas_foto,
      // 'file_ktp' => $file_ktp,
      // 'file_bpjs' => $file_bpjs,
      // 'file_npwp' => $file_npwp,
      // 'file_kk' => $file_kk,
      // 'file_pendidikan' => $file_pendidikan,
      'created_by' => $userData['nama'],
      'updated_by' => $userData['nama'],
    ]);

    session()->setFlashdata('pesan', 'Data karyawan berhasil ditambahkan.');
    return redirect()->to('/data-karyawan');
  }
}
