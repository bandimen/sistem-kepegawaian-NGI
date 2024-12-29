<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class DataKaryawan extends BaseController
{
    protected $folder_directory = "Modules\\DataKaryawan\\Views\\";

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function show_data_karyawan()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Karyawan']),
            'page_title' => view('partials/page-title', ['title' => 'Data Karyawan', 'li_1' => 'Dashboard', 'li_2' => 'Data Karyawan ']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . 'data-karyawan', $data);
    }
}
