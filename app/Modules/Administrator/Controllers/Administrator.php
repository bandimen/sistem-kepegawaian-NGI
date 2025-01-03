<?php

namespace Modules\Administrator\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Divisi\Models\DivisiModel;

class Administrator extends BaseController
{
    protected $folder_directory = "Modules\\Administrator\\Views\\";

    protected $userModel;
    protected $divisiModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->divisiModel = new DivisiModel();
    }

    public function show_manajemen_user()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']); // user yang login
        $users = $this->userModel->getAllUser(); // semua data user
        $divisiData = $this->divisiModel->getAllDivisi();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Manajemen User']),
            'page_title' => view('partials/page-title', ['title' => 'Manajemen User', 'li_1' => 'Administrator', 'li_2' => 'Manajemen User']),
            'userData'   => $userData,
            'users'      => $users,
            'divisiData'     => $divisiData,
        ];

        return view($this->folder_directory . 'manajemen-user', $data);
    }

    public function show_manajemen_jenis_user()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']); // user yang login
        $users = $this->userModel->getAllUser(); // semua data user
        $divisiData = $this->divisiModel->getAllDivisi();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Manajemen User']),
            'page_title' => view('partials/page-title', ['title' => 'Manajemen User', 'li_1' => 'Administrator', 'li_2' => 'Manajemen User']),
            'userData'   => $userData,
            'users'      => $users,
            'divisiData'     => $divisiData,
        ];

        return view($this->folder_directory . 'manajemen-jenis-user', $data);
    }
}
