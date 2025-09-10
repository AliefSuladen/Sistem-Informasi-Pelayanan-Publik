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
        'nomor_surat',
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


    public function getPermohonanByDesa($id_desa, $id_status = null)
    {
        $builder = $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, jenis_surat.surat, status_surat.status, desa.nama_desa')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->join('desa', 'desa.id_desa = user.id_desa', 'left')
            ->where('user.id_desa', $id_desa);

        // Jika id_status diberikan, tambahkan kondisi
        if ($id_status !== null) {
            $builder->where('permohonan_surat.id_status', $id_status);
        }

        return $builder->orderBy('permohonan_surat.created_at', 'DESC')
            ->get()
            ->getResultArray();
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


    public function generateNomorSurat($idJenis)
    {
        // Ambil bulan & tahun sekarang
        $bulan = date('m');
        $tahun = date('Y');

        // Cari nomor terakhir di bulan & tahun ini
        $builder = $this->db->table('permohonan_surat');
        $builder->selectMax('nomor_surat', 'last');
        $builder->like('nomor_surat', "/$tahun", 'before');
        $query = $builder->get()->getRowArray();

        // Ambil angka urut terakhir
        $lastNumber = 0;
        if (!empty($query['last'])) {
            $parts = explode("/", $query['last']); // contoh: 470/001/TK.III/IX/2025
            $lastNumber = intval($parts[1]);       // ambil "001"
        }

        $nextNumber = $lastNumber + 1;

        // Mapping bulan ke romawi
        $romawi = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII'
        ];

        $bulanRomawi = $romawi[$bulan];

        // Format nomor surat sesuai aturan
        return sprintf("470/%03d/TK.III/%s/%s", $nextNumber, $bulanRomawi, $tahun);
    }
    public function generateNomorSuratCamat($idJenis)
    {
        // Ambil tahun sekarang
        $tahun = date('Y');

        // Cari nomor terakhir di tahun ini
        $builder = $this->db->table('permohonan_surat');
        $builder->selectMax('nomor_surat', 'last');
        $builder->like('nomor_surat', "/$tahun", 'before'); // cari yang sesuai tahun
        $query = $builder->get()->getRowArray();

        // Ambil angka urut terakhir
        $lastNumber = 0;
        if (!empty($query['last'])) {
            $parts = explode("/", $query['last']); // contoh: 331.1/001/KLS/YANMUM/2025
            $lastNumber = intval($parts[1]);       // ambil "001"
        }

        $nextNumber = $lastNumber + 1;

        // Format nomor surat sesuai aturan baru
        return sprintf("331.1/%03d/KLS/YANMUM/%s", $nextNumber, $tahun);
    }


    public function getFileSurat($id_permohonan)
    {
        return $this->db->table($this->table)
            ->select('file_surat, id_user, id_status')
            ->where('id_permohonan', $id_permohonan)
            ->get()->getRowArray();
    }

    public function getPermohonanByDesaa($id_desa)
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

    public function getLaporanSurat($id_desa, $bulan = null, $tahun = null)
    {
        $builder = $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, jenis_surat.surat, status_surat.status')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->where('user.id_desa', $id_desa)
            ->where('permohonan_surat.file_surat IS NOT NULL');

        if ($bulan) {
            $builder->where('MONTH(permohonan_surat.created_at)', $bulan);
        }

        if ($tahun) {
            $builder->where('YEAR(permohonan_surat.created_at)', $tahun);
        }

        return $builder->orderBy('permohonan_surat.created_at', 'DESC')->get()->getResultArray();
    }

    public function getPermohonanLegalisasi()
    {
        return $this->db->table($this->table)
            ->select('permohonan_surat.*, user.nama_user, jenis_surat.surat, status_surat.status, desa.nama_desa')
            ->join('user', 'user.id_user = permohonan_surat.id_user', 'left')
            ->join('jenis_surat', 'jenis_surat.id_jenis = permohonan_surat.id_jenis', 'left')
            ->join('status_surat', 'status_surat.id_status = permohonan_surat.id_status', 'left')
            ->join('desa', 'desa.id_desa = user.id_desa', 'left') // join desa untuk dapatkan nama_desa
            ->where('permohonan_surat.id_status', 4) // filter legalisasi
            ->orderBy('permohonan_surat.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
