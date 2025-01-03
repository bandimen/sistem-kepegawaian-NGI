<?php

namespace Modules\ManajemenData\Controllers;

use App\Controllers\BaseController;
use Modules\Jabatan\Controllers\Jabatan;
use Modules\User\Models\UserModel;
use Modules\Jabatan\Models\JabatanModel;
use Modules\Kota\Models\KotaModel;
use Modules\Provinsi\Models\ProvinsiModel;
use Modules\StatusKontrak\Models\StatusKontrakModel;
use Modules\UnitKerja\Models\UnitKerjaModel;

class ManajemenData extends BaseController
{
    protected $folder_directory = "Modules\\ManajemenData\\Views\\";

    protected $userModel;
    protected $jabatanModel;
    protected $unitKerjaModel;
    protected $statusKontrakModel;
    protected $provinsiModel;
    protected $kotaModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->jabatanModel = new JabatanModel();
        $this->unitKerjaModel = new UnitKerjaModel();
        $this->statusKontrakModel = new StatusKontrakModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->kotaModel = new KotaModel();
    }

    public function show_data_provinsi()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);
        $provinsiData = $this->provinsiModel->getAllProvinsi();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Provinsi']),
            'page_title' => view('partials/page-title', ['title' => 'Data Provinsi', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Provinsi']),
            'userData'   => $userData,
            'provinsiData' => $provinsiData,
        ];

        return view($this->folder_directory . 'data-provinsi', $data);
    }
    public function show_data_kota()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);
        $kotaData = $this->kotaModel->getAllKota();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Kota']),
            'page_title' => view('partials/page-title', ['title' => 'Data Kota', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Kota']),
            'userData'   => $userData,
            'kotaData' => $kotaData,
        ];

        return view($this->folder_directory . 'data-kota', $data);
    }
    public function show_data_jabatan()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);
        $jabatanData = $this->jabatanModel->getAllJabatan();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Jabatan']),
            'page_title' => view('partials/page-title', ['title' => 'Data Jabatan', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Jabatan']),
            'userData'   => $userData,
            'jabatanData' => $jabatanData,
        ];

        return view($this->folder_directory . 'data-jabatan', $data);
    }

    public function show_data_unit_kerja()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);
        $unitKerjaData = $this->unitKerjaModel->getAllUnitKerja();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Unit Kerja']),
            'page_title' => view('partials/page-title', ['title' => 'Data Unit Kerja', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Unit Kerja']),
            'userData'   => $userData,
            'unitKerjaData' => $unitKerjaData,
        ];

        return view($this->folder_directory . 'data-unit-kerja', $data);
    }

    public function show_data_status_kontrak()
    {
        $sesi = session()->get();

        $userData = $this->userModel->getUser($sesi['user_id']);
        $statusKontrakData = $this->statusKontrakModel->getAllStatusKontrak();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Data Status Kontrak']),
            'page_title' => view('partials/page-title', ['title' => 'Data Status Kontrak', 'li_1' => 'Manajemen Data', 'li_2' => 'Data Status Kontrak']),
            'userData'   => $userData,
            'statusKontrakData' => $statusKontrakData,
        ];

        return view($this->folder_directory . 'data-status-kontrak', $data);
    }
}
