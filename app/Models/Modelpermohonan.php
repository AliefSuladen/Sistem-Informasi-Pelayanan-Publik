<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpermohonan extends Model
{
    protected $table            = 'permohonan_surat';
    protected $primaryKey       = 'id_permohonan';
    protected $allowedFields    = [
        'id_user',
        'id_jenis',
        'id_status',
        'alasan_sktm',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_ayah',
        'nama_ibu',
        'nama_alm',
        'nik_alm',
        'tempat_kematian',
        'tanggal_kematian',
        'sebab_kematian',
        'tujuan_skck',
        'nama_usaha',
        'jenis_usaha',
        'alamat_usaha',
        'modal_usaha',
        'file_surat',
        'alasan_penolakan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    /**
     * Simpan permohonan surat ke database
     */
    public function simpanPermohonan($data)
    {
        return $this->insert($data);
    }

    // Ambil semua permohonan (digunakan admin)
    public function getAllPermohonan()
    {
        return $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, user.id_desa, jenis_surat.surat, status_surat.status, desa.nama_desa')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->join('desa', 'desa.id_desa = user.id_desa', 'left')
            ->whereIn('status_surat.status', ['Diverifikasi Pihak Desa', 'Selesai'])
            ->orderBy('permohonan_surat.created_at', 'DESC')
            ->get()->getResultArray();
    }

    // Ambil permohonan berdasarkan desa
    public function getPermohonanByDesa($id_desa)
    {
        return $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, jenis_surat.surat, status_surat.status, desa.nama_desa')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->join('desa', 'desa.id_desa = user.id_desa', 'left')
            ->where('user.id_desa', $id_desa)
            ->orderBy('permohonan_surat.created_at', 'DESC')
            ->get()->getResultArray();
    }

    // Ambil permohonan berdasarkan user
    public function getPermohonanByUser($id_user)
    {
        return $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, user.id_desa, jenis_surat.surat, status_surat.status')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->where('permohonan_surat.id_user', $id_user)
            ->orderBy('permohonan_surat.created_at', 'DESC')
            ->get()->getResultArray();
    }

    // Ambil permohonan berdasarkan ID
    public function getPermohonanById($id_permohonan)
    {
        return $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, user.email, jenis_surat.surat, status_surat.status, desa.nama_desa')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->join('desa', 'desa.id_desa = user.id_desa', 'left')
            ->where('permohonan_surat.id_permohonan', $id_permohonan)
            ->get()->getRowArray();
    }

    public function getStatistikByDesa($id_desa)
    {
        return $this->db->table($this->table)
            ->select('status_surat.status, COUNT(*) as jumlah')
            ->join('user', 'user.id_user = permohonan_surat.id_user')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status')
            ->where('user.id_desa', $id_desa)
            ->groupBy('status_surat.status')
            ->get()->getResultArray();
    }
    public function getJumlahJenisSuratByDesa($id_desa)
    {
        return $this->db->table($this->table)
            ->select('jenis_surat.surat, COUNT(*) as total')
            ->join('user', 'user.id_user = permohonan_surat.id_user')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis')
            ->where('user.id_desa', $id_desa)
            ->groupBy('permohonan_surat.id_jenis')
            ->get()->getResultArray();
    }



    // Update status permohonan
    public function updateStatus($id_permohonan, $id_status)
    {
        return $this->db->table($this->table)
            ->where('id_permohonan', $id_permohonan)
            ->update(['id_status' => $id_status, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public function getNomorSuratSKL()
    {
        // Ambil nomor urut terakhir untuk jenis SKL (id_jenis = 3)
        $lastSKL = $this->where('id_jenis', 3)
            ->select('id_permohonan')
            ->orderBy('id_permohonan', 'DESC')
            ->first();

        // Tentukan nomor urut berikutnya
        $nomorUrut = ($lastSKL) ? $lastSKL['id_permohonan'] + 1 : 1;

        // Format Nomor Surat (contoh: 0001/SKL/LAIS/2024)
        $tahun = date('Y');
        return sprintf("%04d", $nomorUrut) . "/SKL/LAIS/" . $tahun;
    }

    public function getFileSurat($id_permohonan)
    {
        return $this->db->table($this->table)
            ->select('file_surat, id_user, id_status')
            ->where('id_permohonan', $id_permohonan)
            ->get()->getRowArray();
    }
}
