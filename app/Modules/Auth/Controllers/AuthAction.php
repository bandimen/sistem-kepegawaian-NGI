<?php

namespace App\Modules\Auth\Controllers;

use Modules\Auth\Models\AuthModel;
use App\Controllers\BaseController;

class AuthAction extends BaseController
{
	private $authModel;

	public function __construct()
	{
		$this->authModel = new AuthModel();
		helper('recaptcha');
	}

	public function index()
	{
		return redirect()->to(base_url());
	}
}
