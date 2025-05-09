<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeldesa extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id_desa';
    protected $allowedFields = ['nama_desa'];

    public function getAllDesa()
    {
        return $this->db->table('desa')
            ->select('*')
            ->orderBy('nama_desa', 'ASC')
            ->get()->getResultArray();
    }
    public function getDesaById($id_desa)
    {
        return $this->where('id_desa', $id_desa)->first();
    }
}
