<?php

namespace Modules\StatusKontrak\Models;

use CodeIgniter\Model;

class StatusKontrakModel extends Model
{
    protected $table            = 'status_kontrak';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getAllStatusKontrak()
    {
        return $this->select('*')->where('is_deleted', 0)->findAll();
    }
}
