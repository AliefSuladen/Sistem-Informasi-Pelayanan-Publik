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

    public function get_user_terdaftar()
    {
        return $this->db->table('desa')
            ->select('desa.id_desa, desa.nama_desa, COUNT(user.id_user) as jumlah_warga')
            ->join('user', 'user.id_desa = desa.id_desa AND user.role = 3', 'left')
            ->groupBy('desa.id_desa')
            ->orderBy('desa.id_desa', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function get_admin_desa()
    {
        return $this->db->table('user')
            ->select('user.id_user, user.nama_user, user.email, desa.nama_desa')
            ->join('desa', 'desa.id_desa = user.id_desa', 'left')
            ->where('user.role', 2)
            ->orderBy('desa.id_desa', 'ASC')
            ->get()
            ->getResultArray();
    }
}
