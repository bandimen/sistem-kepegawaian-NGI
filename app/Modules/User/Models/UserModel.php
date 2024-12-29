<?php

namespace Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $allowedFields    = ['id', 'nama', 'email', 'password', 'jenis_user_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'is_deleted'];

    public function getUser($userId)
    {
        $result = $this->db->table('user')
            ->select('user.*, jenis_user.nama AS nama_jenis_user')
            ->join('jenis_user', 'jenis_user.id = user.jenis_user_id')
            ->where('user.id', $userId)
            ->get()
            ->getRowArray();

        return $result;
    }

    public function isPegawai($userId)
    {
        $result = $this->db->table('user')
            ->select('jenis_user.nama AS nama_jenis_user')
            ->join('jenis_user', 'jenis_user.id = user.jenis_user_id')
            ->where('user.id', $userId)
            ->get()
            ->getRowArray();

        return $result['nama_jenis_user'] === "Pegawai";
    }
}
