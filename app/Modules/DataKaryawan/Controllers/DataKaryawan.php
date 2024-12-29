<?php

namespace Modules\DataKaryawan\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;
use Modules\Divisi\Models\DivisiModel;
use Modules\Grade\Models\GradeModel;
use Modules\Jabatan\Models\JabatanModel;
use Modules\Kota\Models\KotaModel;
use Modules\Provinsi\Models\ProvinsiModel;
use Modules\StatusKontrak\Models\StatusKontrakModel;
use Modules\StatusPernikahan\Models\StatusPernikahanModel;
use Modules\UnitKerja\Models\UnitKerjaModel;

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
    }

    public function show_data_karyawan()
    {
        $sesi = session()->get();

        $userData = $this->userModel->where('id', $sesi['user_id'])->first();
        $provinsiData = $this->provinsiModel->getAllProvinsi();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Karyawan']),
            'page_title' => view('partials/page-title', ['title' => 'Data Karyawan', 'li_1' => 'Dashboard', 'li_2' => 'Data Karyawan ']),
            'userData'   => $userData,
            'provinsiData' => $provinsiData,
        ];
        return view($this->folder_directory . 'data-karyawan', $data);
    }
}
