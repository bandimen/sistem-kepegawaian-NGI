<?php

namespace Modules\Divisi\Controllers;

use App\Controllers\BaseController;

class Divisi extends BaseController
{
    protected $folder_directory = "Modules\\Divisi\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}