<?php

namespace Modules\JenisUser\Controllers;

use App\Controllers\BaseController;

class JenisUser extends BaseController
{
    protected $folder_directory = "Modules\\JenisUser\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}