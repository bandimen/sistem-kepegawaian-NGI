<?php

namespace Modules\Karyawan\Models;

use CodeIgniter\Model;

use Modules\User\Controllers\User;
use Modules\Divisi\Controllers\Divisi;
use Modules\Jabatan\Controllers\Jabatan;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id';

    public $useTimestamps = true;

    protected $allowedFields = [
        'nama',
        'nip',
        'nik',
        'npwp',
        'no_bpjs',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'email_kantor',
        'email_pribadi',
        'alamat_ktp',
        'alamat_domisili',
        'alamat_korespondensi',
        'no_telp',
        'grade_id',
        'status_kontrak_id',
        'status_pernikahan_id',
        'jml_tanggungan',
        'no_rek',
        'kota_id',
        'user_id',
        'unit_kerja_id',
        'divisi_id',
        'jabatan_id',
        'tanggal_masuk',
        'pas_foto',
        'file_ktp',
        'file_bpjs',
        'file_npwp',
        'file_kk',
        'file_pendidikan',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    // Relasi ke Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    // // Relasi ke Unit Kerja
    // public function unitKerja()
    // {
    //     return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    // }
}
