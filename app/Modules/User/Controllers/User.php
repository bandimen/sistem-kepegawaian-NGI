<?php

namespace Modules\User\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $folder_directory = "Modules\\User\\Views\\";

    public function index()
    {
        return view($this->folder_directory . 'index');
    }
}