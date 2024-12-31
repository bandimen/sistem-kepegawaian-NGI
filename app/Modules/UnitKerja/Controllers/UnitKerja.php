<?php

namespace Modules\UnitKerja\Controllers;

use App\Controllers\BaseController;

class UnitKerja extends BaseController
{
    protected $folder_directory = "Modules\\UnitKerja\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}