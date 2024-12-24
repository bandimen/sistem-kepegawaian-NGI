<?php

namespace Modules\User\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $folder_directory = "Modules\\User\\Views\\";

    public function index()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
            'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
        ];
        return view($this->folder_directory . 'dashboard', $data);
    }
}
