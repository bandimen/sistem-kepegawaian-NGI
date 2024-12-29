<?php

namespace Modules\Divisi\Models;

use CodeIgniter\Model;
use Modules\Karyawan\Controllers\Karyawan;

class DivisiModel extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'nama',
        'unit_kerja_id',
    ];
    protected $allowedFields    = ['nama', 'unit_kerja_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];


    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }
}
