<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Kota\Models\KotaModel;
use Modules\Karyawan\Models\KaryawanModel;

class DetailsDataKaryawan extends BaseController
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

     public function details($id_karyawan)
     {
          // $karyawans = $this->karyawanModel
          // ->select('karyawan.*, divisi.nama as divisi, jabatan.nama as jabatan')
          // ->join('divisi', 'divisi.id = karyawan.divisi_id', 'left')
          // ->join('jabatan', 'jabatan.id = karyawan.jabatan_id', 'left')
          // ->find($id_karyawan);

          // $karyawans = $this->karyawanModel->getAllKaryawan();

          // Ambil data karyawan berdasarkan ID
          $karyawans = $this->karyawanModel->find($id_karyawan);

          if (!$karyawans) {
               return $this->response->setJSON(['status' => 'error', 'message' => 'Data karyawan tidak ditemukan.']);
          }

          // Kembalikan data sebagai JSON
          return $this->response->setJSON(['status' => 'success', 'data' => $karyawans]);
     }
}
