<?php

namespace Modules\Karyawan\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'nik', 'nip', 'npwp', 'no_bpjs', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'email_kantor', 'email_pribadi', 'alamat_ktp', 'alamat_domisili', 'alamat_korespondensi', 'no_telp', 'grade_id', 'status_kontrak_id', 'status_pernikahan_id', 'jml_tanggungan', 'no_rek', 'kota_id', 'user_id', 'unit_kerja_id', 'divisi_id', 'jabatan_id', 'tanggal_masuk', 'pas_foto', 'file_ktp', 'file_bpjs', 'file_npwp', 'file_kk', 'file_pendidikan', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];
}
