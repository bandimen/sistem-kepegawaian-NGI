<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Kota\Models\KotaModel;
use Modules\Karyawan\Models\KaryawanModel;

class DeleteDataKaryawan extends BaseController
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

  public function delete()
  {
    $id = $this->request->getPost('id');
    $userId = $this->karyawanModel->getUserId($id);

    if (!$userId) {
      return $this->response->setJSON([
        'success' => false,
      ]);
    }

    $this->karyawanModel->deleteKaryawan($id);
    $this->userModel->deleteUser($userId);

    return $this->response->setJSON([
      'success' => true,
    ]);
  }
}
