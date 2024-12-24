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
            session()->setFlashdata('error', 'Please input email and password.');
            return redirect()->back();
        }

        // verifikasi dgn database
        $userData = $user->where('email', $email)->first();
        $jenisUserData = $jenisUser->where('id', $userData['jenis_user_id'])->first();

        if ($userData && $userData['password'] === sha1($password)) {
            // login berhasil, simpan datanya ke sesi
            session()->set([
                'user_id' => $userData['id'],
                'email' => $userData['email'],
                'is_logged_in' => true,
            ]);
            session()->set($userData);
            // redirect ke halaman sesuai jenis user
            if ($jenisUserData['nama'] == 'Admin') {
                echo 'hai admin';
            } elseif ($jenisUserData['nama'] == 'Pegawai') {
                echo 'hai pegawai';
            }

            // return redirect()->to('/user/dashboard');
        } else {
            // login gagal
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->back();
        }
    }
}
