<?php

namespace Modules\ManajemenData\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class ManajemenData extends BaseController
{
    protected $folder_directory = "Modules\\ManajemenData\\Views\\";

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function show_manajemen_provinsi()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Provinsi']),
            'page_title' => view('partials/page-title', ['title' => 'Data Provinsi', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Provinsi']),
            'userData'   => $userData,
        ];

        return view($this->folder_directory . 'manajemen-provinsi', $data);
    }
    public function show_manajemen_kota()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Kota']),
            'page_title' => view('partials/page-title', ['title' => 'Data Kota', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Kota']),
            'userData'   => $userData,
        ];

        return view($this->folder_directory . 'manajemen-kota', $data);
    }
    public function show_data_jabatan()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Jabatan']),
            'page_title' => view('partials/page-title', ['title' => 'Data Jabatan', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Jabatan']),
            'userData'   => $userData,
        ];

        return view($this->folder_directory . 'data-jabatan', $data);
    }

    public function show_data_unit_kerja()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Jabatan']),
            'page_title' => view('partials/page-title', ['title' => 'Data Jabatan', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Jabatan']),
            'userData'   => $userData,
        ];

        return view($this->folder_directory . 'data-unit-kerja', $data);
    }
}
