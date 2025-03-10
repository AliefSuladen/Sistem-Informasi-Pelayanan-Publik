<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class Modelauth extends Model
{
    public function login($email, $password)
    {
        // Query untuk mencari user berdasarkan email
        return $this->db->table('user')
            ->select('user.*, jabatan.jabatan as role') // Ambil nama jabatan sebagai role
            ->join('jabatan', 'jabatan.id = user.role', 'left') // Join tabel jabatan
            ->where('email', $email) // Pencarian berdasarkan email
            ->where('password', $password) // Bandingkan password secara langsung
            ->get()->getRowArray();
    }
}
