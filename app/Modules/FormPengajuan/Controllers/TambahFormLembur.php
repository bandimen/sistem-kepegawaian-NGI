<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Divisi\Models\DivisiModel;
use Modules\Karyawan\Models\KaryawanModel;

class TambahDataKaryawan extends BaseController
{
    protected $folder_directory = "Modules\\DataKaryawan\\Views\\";

    protected $userModel;
    protected $divisiModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->divisiModel = new DivisiModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function tambah()
    {
        $sesi = session()->get();
        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        if (!$userData) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan atau sesi telah berakhir');
        }

        $data = [
          'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
          'page_title' => view('partials/page-title', ['title' => 'Form Lembur', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
          'userData'   => $userData,
      ];

        return view($this->folder_directory . 'form-lembur', $data);
    }

    public function simpan()
    {
        $validationRules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'nip' => 'required|numeric|min_length[5]',
            'divisi' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->karyawanModel->save([
            'nama' => $this->request->getVar('nama'),
            'nip' => $this->request->getVar('nip'),
            'divisi' => $this->request->getVar('divisi'),
            'created_by' => session()->get('user_id'),
        ]);

        return redirect()->to('/form-lembur');
    }
}
