<?php

namespace Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $allowedFields    = ['id', 'nama', 'email', 'password', 'jenis_user_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'is_deleted'];
}
