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

    public function getAllKaryawan()
    {
        return $this->select('user.id as user_id, user.nama as user_nama, user.email as user_email, karyawan.*, divisi.nama as divisi, jabatan.nama as jabatan, grade.kategori as grade, status_kontrak.status as status_kontrak, status_pernikahan.status as status_pernikahan, kota.nama as kota, provinsi.nama as provinsi, unit_kerja.nama as unit_kerja')
            ->join('user', 'karyawan.user_id = user.id', 'left')
            ->join('divisi', 'karyawan.divisi_id = divisi.id', 'left')
            ->join('jabatan', 'karyawan.jabatan_id = jabatan.id', 'left')
            ->join('grade', 'karyawan.grade_id = grade.id', 'left')
            ->join('status_kontrak', 'karyawan.status_kontrak_id = status_kontrak.id', 'left')
            ->join('status_pernikahan', 'karyawan.status_pernikahan_id = status_pernikahan.id', 'left')
            ->join('kota', 'karyawan.kota_id = kota.id', 'left')
            ->join('provinsi', 'kota.kode_provinsi = provinsi.kode', 'left')
            ->join('unit_kerja', 'karyawan.unit_kerja_id = unit_kerja.id', 'left')
            ->where('karyawan.is_deleted', 0)
            ->findAll();
    }

    public function getUserId($id)
    {
        $result = $this->select('user.id as id')
            ->join('user', 'karyawan.user_id = user.id')
            ->where('karyawan.id', $id)
            ->first();

        return $result ? $result['id'] : null;
    }

    public function deleteKaryawan($id)
    {
        return $this->update($id, ['is_deleted' => 1]);
    }
}
