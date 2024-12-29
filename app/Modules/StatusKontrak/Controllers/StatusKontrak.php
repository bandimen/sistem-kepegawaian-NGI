<?php

namespace Modules\StatusKontrak\Controllers;

use App\Controllers\BaseController;

class StatusKontrak extends BaseController
{
    protected $folder_directory = "Modules\\StatusKontrak\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}