<?php

namespace Modules\Grade\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table            = 'grade';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['kategori', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];
}