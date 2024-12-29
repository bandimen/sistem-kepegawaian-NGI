<?php

namespace Modules\Administrator\Controllers;

use App\Controllers\BaseController;
use Modules\User\Models\UserModel;

class Administrator extends BaseController
{
    protected $folder_directory = "Modules\\Administrator\\Views\\";

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
}
