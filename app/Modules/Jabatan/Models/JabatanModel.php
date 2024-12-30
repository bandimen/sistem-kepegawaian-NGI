<?php

namespace Modules\Jabatan\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table            = 'jabatan';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getAllJabatan()
    {
        return $this->select('*')->where('is_deleted', 0)->findAll();
    }
}
