<?php

namespace Modules\ManajemenData\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Jabatan\Models\JabatanModel;

class JabatanAjax extends BaseController
{
  protected $folder_directory = "Modules\\ManajemenData\\Views\\";

  protected $userModel;
  protected $jabatanModel;
  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->jabatanModel = new JabatanModel();
  }

  public function cekNamaJabatan()
  {
    $nama = $this->request->getGet('nama');

    $exists = $this->jabatanModel->where('nama', $nama)->where('is_deleted', 0)->countAllResults() > 0;

    return $this->response->setJSON(['exists' => $exists]);
  }

  public function cekLabelJabatan()
  {
    $label = $this->request->getGet('label');

    $exists = $this->jabatanModel->where('label', $label)->where('is_deleted', 0)->countAllResults() > 0;

    return $this->response->setJSON(['exists' => $exists]);
  }

  // public function getAllJabatan()
  // {
  //   $jabatanData = $this->jabatanModel->getAllJabatan();
  //   return $this->response->setJSON(['jabatanData' => $jabatanData]);
  // }
}
