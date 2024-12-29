<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class Dashboard extends BaseController
{
    protected $folder_directory = "Modules\\Dashboard\\Views\\";

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
            'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard']),
            'userData'   => $userData,
        ];

        return view($this->folder_directory . 'dashboard', $data);
    }

    public function show_profil()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Profile']),
            'page_title' => view('partials/page-title', ['title' => 'Profil', 'li_1' => 'Contacts', 'li_2' => 'Profile']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . 'profil', $data);
    }
}
