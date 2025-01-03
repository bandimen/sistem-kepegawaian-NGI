<?php

namespace Modules\ManajemenData\Controllers;

use App\Controllers\BaseController;
use Modules\Jabatan\Controllers\Jabatan;
use Modules\User\Models\UserModel;
use Modules\Jabatan\Models\JabatanModel;

class JabatanController extends BaseController
{
  protected $folder_directory = "Modules\\ManajemenData\\Views\\";

  protected $userModel;
  protected $jabatanModel;
  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->jabatanModel = new JabatanModel();
  }

  public function tambah()
  {
    // entitas yang login
    $sesi = session()->get();
    $userData = $this->userModel->where('id', $sesi['user_id'])->first();

    // field input
    $nama = $this->request->getVar('nama');
    $label = $this->request->getVar('label');

    $data = [
      'nama' => $nama,
      'label' => $label,
      'updated_by' => $userData['id'],
      'updated_at' => date('Y-m-d H:i:s')
    ];

    // jika nama/label udah ada di db, maka update
    $jabatan = $this->jabatanModel->getJabatanByStrings([$nama, $label]);

    if (!empty($jabatan)) {
      $this->jabatanModel->updateJabatan($jabatan[0]['id'], $data);
    } else {
      // create jabatan baru
      $data['created_by'] = $userData['id'];
      $this->jabatanModel->insert($data);
    }
    return redirect()->to('/data-jabatan');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');

    if (!$id) {
      return $this->response->setJSON([
        'success' => false,
      ]);
    }

    $this->jabatanModel->deleteJabatan($id);

    return $this->response->setJSON([
      'success' => true,
    ]);
  }
}
