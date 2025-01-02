<?php

namespace Modules\DataKaryawan\Controllers;

use Modules\User\Models\UserModel;
use App\Controllers\BaseController;
use Modules\Divisi\Models\DivisiModel;
use Modules\Grade\Models\GradeModel;
use Modules\Jabatan\Models\JabatanModel;
use Modules\Kota\Models\KotaModel;
use Modules\Provinsi\Models\ProvinsiModel;
use Modules\StatusKontrak\Models\StatusKontrakModel;
use Modules\StatusPernikahan\Models\StatusPernikahanModel;
use Modules\UnitKerja\Models\UnitKerjaModel;
use Modules\Karyawan\Models\KaryawanModel;

class DataKaryawan extends BaseController
{
    protected $folder_directory = "Modules\\DataKaryawan\\Views\\";
    protected $userModel;
    protected $divisiModel;
    protected $gradeModel;
    protected $jabatanModel;
    protected $kotaModel;
    protected $provinsiModel;
    protected $statusKontrakModel;
    protected $statusPernikahanModel;
    protected $unitKerjaModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->divisiModel = new DivisiModel();
        $this->gradeModel = new GradeModel();
        $this->jabatanModel = new JabatanModel();
        $this->kotaModel = new KotaModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->statusKontrakModel = new StatusKontrakModel();
        $this->statusPernikahanModel = new StatusPernikahanModel();
        $this->unitKerjaModel = new UnitKerjaModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function show_data_karyawan()
    {
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();

        $karyawans = $this->karyawanModel->getAllKaryawan();

        $sesi = session()->get();
        $userData = $this->userModel->where('id', $sesi['user_id'])->first();
        $provinsiData = $this->provinsiModel->getAllProvinsi();
        $divisiData = $this->divisiModel->getAllDivisi();
        $gradeData = $this->gradeModel->getAllGrade();
        $jabatanData = $this->jabatanModel->getAllJabatan();
        $statusKontrakData = $this->statusKontrakModel->getAllStatusKontrak();
        $statusPernikahanData = $this->statusPernikahanModel->getAllStatusPernikahan();
        $unitKerjaData = $this->unitKerjaModel->getAllUnitKerja();
        $kotaData = $this->kotaModel->getAllKota();

        $data = [
            'validation' => session()->get('validation'),  // Ambil validasi dari session flashdata
            'pesanError' => session()->getFlashdata('pesanError'), // Ambil pesan error
            'pesanSukses' => session()->getFlashdata('pesanSukses'),
            'title_meta' => view('partials/title-meta', ['title' => 'Data Karyawan']),
            'page_title' => view('partials/page-title', ['title' => 'Data Karyawan', 'li_1' => 'Dashboard', 'li_2' => 'Data Karyawan']),
            'userData' => $userData,
            'karyawans' => $karyawans,
            'provinsiData' => $provinsiData,
            'divisiData' => $divisiData,
            'gradeData' => $gradeData,
            'kotaData' => $kotaData,
            'unitKerjaData' => $unitKerjaData,
            'statusPernikahanData' => $statusPernikahanData,
            'statusKontrakData' => $statusKontrakData,
            'jabatanData' => $jabatanData,
        ];

        return view($this->folder_directory . 'data-karyawan', $data);
    }
    

    // public function store_to_karyawan()
    // {
    //     $users = $this->userModel
    //         ->select('user.id, user.nama, user.email, divisi.id as divisi_id, jabatan.id as jabatan_id')
    //         ->join('divisi', 'user.divisi_id = divisi.id', 'left')
    //         ->join('jabatan', 'user.jabatan_id = jabatan.id', 'left')
    //         ->where('user.is_deleted', 0)
    //         ->findAll();

    //     foreach ($users as $user) {
    //         $this->karyawanModel->insert([
    //             'nama' => $user['nama'],
    //             'email_kantor' => $user['email'],
    //             'divisi_id' => $user['divisi_id'],
    //             'jabatan_id' => $user['jabatan_id'],
    //             'tanggal_masuk' => date("Y-m-d"),
    //         ]);
    //     }

    //     return redirect()->to('/data-karyawan')->with('success', 'Data berhasil disimpan ke tabel karyawan.');
    // }
}