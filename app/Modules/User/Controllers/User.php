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

    public function show_form_lembur()
    {
        $sesi = session()->get();

        $user = new UserModel();
        $userData = $user->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Lembur', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . "\\form\\" . 'form-lembur', $data);
    }

    public function show_form_cuti()
    {
        $sesi = session()->get();

        $user = new UserModel();
        $userData = $user->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Cuti', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . "\\form\\" . 'form-cuti', $data);
    }

    public function show_form_dinas_luar()
    {
        $sesi = session()->get();

        $user = new UserModel();
        $userData = $user->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Dinas Luar', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . "\\form\\" . 'form-dinas-luar', $data);
    }

    public function show_form_peminjaman_karyawan()
    {
        $sesi = session()->get();

        $user = new UserModel();
        $userData = $user->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form peminjaman Karyawan', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . "\\form\\" . 'form-peminjaman-karyawan', $data);
    }
    public function show_form_slip_gaji()
    {
        $sesi = session()->get();

        $user = new UserModel();
        $userData = $user->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Slip Gaji', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory . "\\form\\" . 'form-slip-gaji', $data);
    }
}
