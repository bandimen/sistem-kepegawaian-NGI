<?php

namespace Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    // protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'username', 'password', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getUser($userId)
    {
        $result = $this->db->table('user')
            ->select('user.*')
            ->where('user.id', $userId)
            ->get()
            ->getRowArray();

        return $result;
    }

    // public function getUser($userId)
    // {
    //     $result = $this->db->table('user')
    //         ->select('user.*, grade.kategori AS grade, status_kontrak.status AS status_kontrak, status_pernikahan.status AS status_pernikahan')
    //         ->join('grade', 'grade.id = user.grade_id')
    //         ->join('status_kontrak', 'status_kontrak.id = user.status_kontrak_id')
    //         ->join('status_pernikahan', 'status_pernikahan.id = user.status_pernikahan_id')
    //         ->where('user.id', $userId)
    //         ->get()
    //         ->getRowArray();

    //     return $result;
    // }

}
