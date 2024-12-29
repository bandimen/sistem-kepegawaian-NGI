<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Karyawan\Models\KaryawanModel;

class TambahDataKaryawan extends BaseController
{
  protected $folder_directory = "Modules\\DataKaryawan\\Views\\";

  protected $userModel;
  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  // public function tambahKaryawan()
  // {
  //   if ($this->request->isAJAX()) {
  //     $validation = \Config\Services::validation();

  //     $valid = $this->validate([
  //       'nama' => [
  //         'label' => 'Nama',
  //         'rules' => 'required|alpha_space',
  //         'errors' => [
  //           'required' => 'Nama tidak boleh kosong',
  //           'alpha_space' => 'Nama hanya boleh berisi huruf dan spasi',
  //         ]
  //       ]
  //     ]);

  //     if (!$valid) {
  //       $msg = [
  //         'error' => [
  //           'nama' => $validation->getError('nama'),
  //         ]
  //       ];

  //       return $this->response->setJSON($msg);
  //     }

  //     // Jika validasi berhasil
  //     $data = [
  //       'nama' => $this->request->getPost('nama'),
  //     ];

  //     // Simpan ke database
  //     $model = new KaryawanModel();
  //     $model->insert($data);

  //     $msg = [
  //       'success' => 'Data karyawan berhasil ditambahkan'
  //     ];

  //     return $this->response->setJSON($msg);
  //   } else {
  //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
  //   }
  // }
}
