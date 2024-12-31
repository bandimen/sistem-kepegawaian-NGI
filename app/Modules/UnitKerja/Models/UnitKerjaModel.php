<?php

namespace Modules\UnitKerja\Models;

use CodeIgniter\Model;

class UnitKerjaModel extends Model
{
    protected $table            = 'unit_kerja';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getAllUnitKerja()
    {
        return $this->select('*')->where('is_deleted', 0)->findAll();
    }
}
