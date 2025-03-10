<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeldokumen;


class Desa extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldokumen = new Modeldokumen();
    }
    public function index()
    {

        $id_desa = session()->get('id_desa');

        if (!$id_desa) {
            return redirect()->to('/login');
        }

        $data['permohonan'] = $this->Modelpermohonan->getPermohonanByDesa($id_desa);

        return view('Admin/Desa/v-datasurat', $data);
    }

    public function cek_dokumen($id_permohonan)
    {
        // Ambil data permohonan berdasarkan ID permohonan
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);

        if (!$permohonan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permohonan tidak ditemukan.');
        }

        // Ambil dokumen pendukung berdasarkan ID permohonan
        $dokumenPendukung = $this->Modeldokumen->getDokumenByPermohonan($id_permohonan);

        $data = [
            'permohonan' => $permohonan,
            'dokumenPendukung' => $dokumenPendukung
        ];

        return view('Admin/Desa/v-cek-dokumen', $data);
    }

    public function terima_berkas($id_permohonan)
    {
        // Cek apakah permohonan ada
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);

        if (!$permohonan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permohonan tidak ditemukan.');
        }

        // Ubah status permohonan menjadi Diverifikasi (misalnya id_status = 2)
        $this->Modelpermohonan->updateStatus($id_permohonan, 2); // Asumsikan id_status 2 adalah 'Diverifikasi'
        session()->setFlashdata('success', 'Permohonan berhasil diverifikasi.');
        // Redirect kembali ke halaman daftar pengajuan dengan pesan sukses
        return redirect()->to(base_url('daftar-pengajuan'));
    }
}
