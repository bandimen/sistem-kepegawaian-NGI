<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $folder_directory = "Modules\\Auth\\Views\\";

    public function index() // login
    {
        $userModel = new \Modules\User\Models\UserModel();
        $login = $this->request->getPost('submit');
        // jika tombol log in ditekan
        if ($login) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if ($email == '' || $password == '') {
                $err = "Please input email and password.";
            }
            // jika ada error
            if ($err) {
                session()->setFlashdata('error', $err);
                return redirect()->to(base_url('auth'));
            }
        }

        return view($this->folder_directory . 'index');
    }
}
