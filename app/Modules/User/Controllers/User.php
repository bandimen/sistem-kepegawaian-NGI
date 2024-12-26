<?php

namespace Modules\User\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class User extends BaseController
{
    protected $folder_directory = "Modules\\User\\Views\\";

    public function index()
    {
        $sesi = session()->get();

        $user = new UserModel();
        $userData = $user->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
            'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard']),
            'userData'   => $userData,
        ];

        return view($this->folder_directory . 'dashboard', $data);
    }
}
