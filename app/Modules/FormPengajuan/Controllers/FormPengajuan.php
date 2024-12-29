<?php

namespace Modules\FormPengajuan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class FormPengajuan extends BaseController
{
    protected $folder_directory = "Modules\\FormPengajuan\\Views\\";

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    public function show_form_lembur()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Lembur', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory  . 'form-lembur', $data);
    }

    public function show_form_cuti()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Cuti', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory  . 'form-cuti', $data);
    }

    public function show_form_dinas_luar()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Dinas Luar', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory  . 'form-dinas-luar', $data);
    }

    public function show_form_peminjaman_karyawan()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Peminjaman Karyawan', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory  . 'form-peminjaman-karyawan', $data);
    }

    public function show_form_slip_gaji()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
            'page_title' => view('partials/page-title', ['title' => 'Form Slip Gaji', 'li_1' => 'Forms', 'li_2' => 'Basic Elements', 'li_3' => 'Dashboard']),
            'userData'   => $userData,
        ];
        return view($this->folder_directory  . 'form-slip-gaji', $data);
    }
}
