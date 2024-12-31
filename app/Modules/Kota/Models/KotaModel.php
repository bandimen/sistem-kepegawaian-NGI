<?php

namespace Modules\Kota\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table            = 'kota';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['kode', 'nama', 'kode_provinsi', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getAllKota()
    {
        return $this->select('*')->where('is_deleted', 0)->findAll();
    }
}
