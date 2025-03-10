<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeljenissurat extends Model
{
    protected $table = 'jenis_surat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jenis'];
    public function getAllJenisSurat()
    {
        return $this->db->table('jenis_surat')
            ->select('*')
            ->get()->getResultArray();
    }
}
