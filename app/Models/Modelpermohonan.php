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
        'ttl_alm',
        'kelamin_alm',
        'agama_alm',
        'pekerjaan_alm',
        'alamat_alm',
        'tempat_kematian',
        'tanggal_kematian',
        'sebab_kematian',
        'tujuan_skck',
        'nama_usaha',
        'alamat_usaha',
        'brg_hilang',
        'tgl_hilang',
        'tempat_kehilangan',
        'nomor_kk',
        'nama_kk',
        'alamat_tujuan',
        'desa_tujuan',
        'kec_tujuan',
        'kab_tujuan',
        'jumlah_pindah',
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

    public function getLaporan($tahun, $bulan)
    {
        $builder = $this->db->table('permohonan_surat');
        $builder->select('jenis_surat.surat as jenis_surat, COUNT(*) as total');
        $builder->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis');

        if ($tahun) {
            $builder->where('YEAR(permohonan_surat.created_at)', $tahun);
        }

        if ($bulan) {
            $builder->where('MONTH(permohonan_surat.created_at)', $bulan);
        }

        $builder->groupBy('permohonan_surat.id_jenis');

        return $builder->get()->getResultArray();
    }

    public function getStatistikGlobal()
    {
        return $this->db->table($this->table)
            ->select('status_surat.status, COUNT(*) as jumlah')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status')
            ->groupBy('status_surat.status')
            ->get()->getResultArray();
    }

    public function getJumlahJenisSuratGlobal()
    {
        return $this->db->table($this->table)
            ->select('jenis_surat.surat, COUNT(*) as total')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis')
            ->groupBy('permohonan_surat.id_jenis')
            ->get()->getResultArray();
    }




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
            ->select('permohonan_surat.*, user.nama_user,user.nik, user.id_desa, jenis_surat.surat, status_surat.status')
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
            ->select('permohonan_surat.*, user.nama_user,user.nik,user.kelamin,user.agama, user.email,user.pekerjaan,user.alamat,user.tempat_lahir,user.tgl_lahir, jenis_surat.surat, status_surat.status, desa.nama_desa')
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
        $lastSKL = $this->where('id_jenis', 3)
            ->select('id_permohonan')
            ->orderBy('id_permohonan', 'DESC')
            ->first();

        $nomorUrut = ($lastSKL) ? $lastSKL['id_permohonan'] + 1 : 1;

        $tahun = date('Y');
        return sprintf("%04d", $nomorUrut) . "/SKL/LAIS/" . $tahun;
    }

    public function getNomorSuratPindah()
    {
        $lastpindah = $this->where('id_jenis', 8)
            ->select('id_permohonan')
            ->orderBy('id_permohonan', 'DESC')
            ->first();

        $nomorUrut = ($lastpindah) ? $lastpindah['id_permohonan'] + 1 : 1;

        $tahun = date('Y');
        return sprintf("%04d", $nomorUrut) . "/SKP/LAIS/" . $tahun;
    }
    public function getNomorSuratDomisili()
    {
        // Ambil tahun dan bulan saat ini
        $tahun = date('Y');
        $bulan = date('m');

        $count = $this->db->table($this->table)
            ->where('id_jenis', 2)
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $nomorSurat = $nomorUrut . '/DS/LAIS/' . $bulan . '/' . $tahun;

        return $nomorSurat;
    }

    public function getNomorKehilangan()
    {
        $bulanRomawi = [
            1 => 'I',
            'II',
            'III',
            'IV',
            'V',
            'VI',
            'VII',
            'VIII',
            'IX',
            'X',
            'XI',
            'XII'
        ];

        $bulan = date('n');
        $tahun = date('Y');


        $count = $this->where('id_jenis', 6)
            ->where('YEAR(updated_at)', $tahun)
            ->countAllResults();

        $nomorUrut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        $nomor = "$nomorUrut/SKH/LAIS/{$bulanRomawi[$bulan]}/$tahun";

        return $nomor;
    }
    public function getNomorSuratKematian()
    {
        $kodeSurat = '474.3';
        $bulanRomawi = [
            1 => 'I',
            'II',
            'III',
            'IV',
            'V',
            'VI',
            'VII',
            'VIII',
            'IX',
            'X',
            'XI',
            'XII'
        ];

        $bulan = (int)date('m');
        $tahun = date('Y');
        $romawi = $bulanRomawi[$bulan];

        // Hitung jumlah surat kematian yang sudah dibuat bulan ini
        $builder = $this->db->table('permohonan_surat');
        $builder->where('id_jenis', 4);
        $builder->where('MONTH(created_at)', $bulan);
        $builder->where('YEAR(created_at)', $tahun);
        $jumlah = $builder->countAllResults() + 1;

        // Format nomor: 474.3/[NOMOR]/LAIS/[ROMAWI]/[TAHUN]
        return sprintf('%s/%03d/LAIS/%s/%s', $kodeSurat, $jumlah, $romawi, $tahun);
    }
    public function getNomorSuratKeteranganUsaha()
    {
        // Asumsikan id_jenis untuk Surat Keterangan Usaha adalah 5 (ubah sesuai yang kamu gunakan di DB)
        $last = $this->where('id_jenis', 7)
            ->select('id_permohonan')
            ->orderBy('id_permohonan', 'DESC')
            ->first();

        $nomorUrut = ($last) ? $last['id_permohonan'] + 1 : 1;

        $tahun = date('Y');
        return sprintf("%04d", $nomorUrut) . "/SKU/LAIS/" . $tahun;
    }

    public function getNomorSuratPengantarSKCK()
    {

        $last = $this->where('id_jenis', 5)
            ->select('id_permohonan')
            ->orderBy('id_permohonan', 'DESC')
            ->first();

        $nomorUrut = ($last) ? $last['id_permohonan'] + 1 : 1;

        $tahun = date('Y');
        return sprintf("%04d", $nomorUrut) . "/SKCK/LAIS/" . $tahun;
    }

    public function getNomorSuratSKTM()
    {
        $last = $this->where('id_jenis', 1)
            ->select('id_permohonan')
            ->orderBy('id_permohonan', 'DESC')
            ->first();

        $nomorUrut = ($last) ? $last['id_permohonan'] + 1 : 1;

        $tahun = date('Y');
        return sprintf("%04d", $nomorUrut) . "/SKTM/LAIS/" . $tahun;
    }


    public function getFileSurat($id_permohonan)
    {
        return $this->db->table($this->table)
            ->select('file_surat, id_user, id_status')
            ->where('id_permohonan', $id_permohonan)
            ->get()->getRowArray();
    }
}
