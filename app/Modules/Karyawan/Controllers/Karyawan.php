<?php

namespace Modules\Karyawan\Controllers;

use App\Controllers\BaseController;

class Karyawan extends BaseController
{
    protected $folder_directory = "Modules\\Karyawan\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}