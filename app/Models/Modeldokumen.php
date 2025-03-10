<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeldokumen extends Model
{
    protected $table = 'dokumen_pengajuan';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = ['id_permohonan', 'nama_dokumen', 'file_dokumen'];

    public function getDokumenByPermohonan($id_permohonan)
    {
        return $this->where('id_permohonan', $id_permohonan)->findAll();
    }
}
