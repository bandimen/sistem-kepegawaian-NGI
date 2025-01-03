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

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // jika input kosong
        if (empty($username) || empty($password)) {
            session()->setFlashdata('username', $username);
            session()->setFlashdata('password', $password);
            session()->setFlashdata('error', 'Please input username and password.');
            return redirect()->back();
        }

        // verifikasi dgn database
        $userData = $user->where('username', $username)->where('is_deleted', 0)->first();

        if ($userData && $userData['password'] === sha1($password)) {
            // // login berhasil, simpan datanya ke sesi
            session()->set([
                'user_id' => $userData['id'],
                'username' => $userData['username'],
                'is_logged_in' => true,
            ]);
            // session()->set($userData);

            return redirect()->to('/dashboard');
        } else {
            // login gagal
            session()->setFlashdata('error', 'Invalid username or password.');
            session()->setFlashdata('username', $username);
            session()->setFlashdata('password', $password);
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
