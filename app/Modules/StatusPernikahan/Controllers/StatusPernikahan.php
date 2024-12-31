<?php

namespace Modules\StatusPernikahan\Controllers;

use App\Controllers\BaseController;

class StatusPernikahan extends BaseController
{
    protected $folder_directory = "Modules\\StatusPernikahan\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}