<?php

namespace Modules\Jabatan\Controllers;

use App\Controllers\BaseController;

class Jabatan extends BaseController
{
    protected $folder_directory = "Modules\\Jabatan\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}