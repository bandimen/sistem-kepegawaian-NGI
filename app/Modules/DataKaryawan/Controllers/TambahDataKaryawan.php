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

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->kotaModel = new KotaModel();
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
}
