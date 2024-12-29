<?php

namespace Modules\Grade\Controllers;

use App\Controllers\BaseController;

class Grade extends BaseController
{
    protected $folder_directory = "Modules\\Grade\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}