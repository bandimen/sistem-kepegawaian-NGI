<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class Auth extends BaseController
{
    protected $folder_directory = "Modules\\Auth\\Views\\";

    public function index()
    {
        // cek apakah user sudah login atau belum
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view($this->folder_directory . 'index');
    }
}
