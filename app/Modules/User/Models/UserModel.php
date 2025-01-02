<?php

namespace Modules\User\Models;

use CodeIgniter\Model;
use Modules\Karyawan\Controllers\Karyawan;

class UserModel extends Model
{
    protected $table            = 'user';
    // protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'username', 'email', 'password', 'divisi_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getUser($userId)
    {
        $result = $this->db->table('user')
            ->select('user.*')
            ->where('user.id', $userId)
            ->get()
            ->getRowArray();

        return $result;
    }

    public function getAllUser()
    {
        return $this->select('user.*, divisi.nama AS divisi')
            ->join('divisi', 'user.divisi_id = divisi.id')
            ->where('user.is_deleted', 0)
            ->get()->getResultArray();
    }

    // Relasi ke Karyawan
    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'user_id');
    }

    public function deleteUser($id)
    {
        return $this->update($id, ['is_deleted' => 1]);
    }
}
