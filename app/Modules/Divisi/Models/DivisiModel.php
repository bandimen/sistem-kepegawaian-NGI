<?php

namespace Modules\Divisi\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table            = 'divisi';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'unit_kerja_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];
}
