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

    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }
}