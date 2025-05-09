<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeluser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nik', 'nama_user', 'email', 'password', 'role', 'id_desa', 'pekerjaan', 'agama', 'kelamin', 'alamat', 'foto'];

    // Cek apakah NIK sudah terdaftar
    public function cekNik($nik)
    {
        return $this->where('nik', $nik)->first();
    }

    public function getUser($id)
    {
        return $this->where('id_user', $id)->first();
    }
}
