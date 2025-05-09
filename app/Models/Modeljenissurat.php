<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeljenissurat extends Model
{
    protected $table = 'jenis_surat';
    protected $primaryKey = 'id_jenis';
    protected $allowedFields = ['surat'];

    public function getAllJenisSurat()
    {
        return $this->db->table('jenis_surat')
            ->select('*')
            ->orderBy('surat', 'ASC')
            ->get()->getResultArray();
    }
}
