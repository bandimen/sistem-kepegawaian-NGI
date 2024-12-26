<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\JenisUser\Models\JenisUserModel;

class AuthController extends BaseController
{

    public function login()
    {
        $user = new UserModel();
        $jenisUser = new JenisUserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // jika input kosong
        if (empty($email) || empty($password)) {
            session()->setFlashdata('email', $email);
            session()->setFlashdata('password', $password);
            session()->setFlashdata('error', 'Please input email and password.');
            return redirect()->back();
        }

        // verifikasi dgn database
        $userData = $user->where('email', $email)->first();

        if ($userData && $userData['password'] === sha1($password)) {
            // // login berhasil, simpan datanya ke sesi
            session()->set([
                'user_id' => $userData['id'],
                'email' => $userData['email'],
                'is_logged_in' => true,
            ]);
            // session()->set($userData);

            return redirect()->to('/dashboard');
        } else {
            // login gagal
            session()->setFlashdata('error', 'Invalid email or password.');
            session()->setFlashdata('email', $email);
            session()->setFlashdata('password', $password);
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
