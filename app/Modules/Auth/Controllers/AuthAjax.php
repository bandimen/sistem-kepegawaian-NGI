<?php

namespace App\Modules\Auth\Controllers;

use Modules\Auth\Models\AuthModel;
use App\Controllers\BaseController;

class AuthAjax extends BaseController
{
    private $authModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }
}
