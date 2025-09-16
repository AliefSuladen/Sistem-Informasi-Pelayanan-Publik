<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelberita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $allowedFields = ['id_user', 'judul', 'slug', 'isi', 'gambar', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getAllBerita($id_user)
    {
        return $this->where('id_user', $id_user)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getBeritaDetail($slug)
    {
        return $this->select('berita.*, user.nama_user as penulis')
            ->join('user', 'user.id_user = berita.id_user', 'left')
            ->where('slug', $slug)
            ->first();
    }

    public function findAllBerita()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function simpanBerita($data)
    {
        return $this->insert($data);
    }
}
