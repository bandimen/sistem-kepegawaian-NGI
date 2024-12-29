<?php

namespace Modules\Kota\Controllers;

use App\Controllers\BaseController;

class Kota extends BaseController
{
    protected $folder_directory = "Modules\\Kota\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}