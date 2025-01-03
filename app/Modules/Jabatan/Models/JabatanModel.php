<?php

namespace Modules\Jabatan\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table            = 'jabatan';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'label', 'created_at', 'updated_at', 'created_by', 'updated_by', 'is_deleted'];

    public function getAllJabatan()
    {
        return $this->select('*')->where('is_deleted', 0)->findAll();
    }

    public function getJabatanByStrings(array $strings)
    {
        $query = $this->db->table('jabatan')->groupStart();

        foreach ($strings as $string) {
            $query->orWhere('nama', $string)->orWhere('label', $string);
        }

        $query->groupEnd();

        return $query->get()->getResultArray();
    }

    public function updateJabatan($id, $data)
    {
        return $this->db->table('jabatan')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteJabatan($id)
    {
        return $this->update($id, ['is_deleted' => 1]);
    }
}
