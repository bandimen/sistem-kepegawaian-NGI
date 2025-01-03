<?php

namespace Modules\User\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class User extends BaseController
{
    protected $folder_directory = "Modules\\User\\Views\\";

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
}
