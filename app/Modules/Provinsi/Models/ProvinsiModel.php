<?php

namespace Modules\Provinsi\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table            = 'provinsi';
    protected $useTimestamps    = true;
    protected $primaryKey       = 'kode';
    protected $allowedFields    = ['kode', 'nama',  'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];
}