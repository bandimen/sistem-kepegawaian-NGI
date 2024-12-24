<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $folder_directory = "Modules\\Auth\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}
