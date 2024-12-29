<?php

namespace Modules\Provinsi\Controllers;

use App\Controllers\BaseController;

class Provinsi extends BaseController
{
    protected $folder_directory = "Modules\\Provinsi\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}