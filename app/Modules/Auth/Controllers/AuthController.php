<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        $user = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // jika input kosong
        if (empty($email) || empty($password)) {
            session()->setFlashdata('error', 'Please input email and password.');
            return redirect()->back();
        }

        // verifikasi dgn database
        $userData = $user->where('email', $email)->first();
        if ($userData && $userData['password'] === sha1($password)) {
            // login berhasil, simpan datanya ke sesi
            session()->set([
                'user_id' => $userData['id'],
                'email' => $userData['email'],
                'is_logged_in' => true,
            ]);
            echo 'miaw';
            // return redirect()->to('/dashboard'); // Ubah sesuai rute setelah login
        } else {
            // login gagal
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->back();
        }
    }
}
