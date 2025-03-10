<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeluser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nik', 'nama_user', 'email', 'password', 'role', 'id_desa'];  // Tambahkan 'id_desa' di sini

    // Aturan unik untuk NIK
    protected $validationRules = [
        'nik' => 'required|is_unique[user.nik]',
    ];

    // Cek apakah NIK sudah terdaftar
    public function cekNik($nik)
    {
        return $this->where('nik', $nik)->first();
    }
}
