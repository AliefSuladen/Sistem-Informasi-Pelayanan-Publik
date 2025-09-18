<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeldokumen;
use App\Models\Modeluser;
use App\Models\Modeldesa;


class Desa extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldokumen = new Modeldokumen();
        $this->Modeluser = new Modeluser();
        $this->Modeldesa = new Modeldesa();
    }

    public function dashboard()
    {
        $id_desa = session()->get('id_desa');

        $desa = $this->Modeldesa->getDesaById($id_desa);
        $statistik = $this->Modelpermohonan->getStatistikByDesa($id_desa);
        $jenisSurat = $this->Modelpermohonan->getJumlahJenisSuratByDesa($id_desa);

        $data = [
            'desa' => $desa,
            'statistik' => $statistik,
            'jenisSurat' => $jenisSurat,
        ];

        return view('Admin/v-desa-dashboard', $data);
    }

    public function data_permohonan()
    {

        $id_desa = session()->get('id_desa');

        if (!$id_desa) {
            return redirect()->to('/login');
        }

        $data['permohonan'] = $this->Modelpermohonan->getPermohonanByDesa($id_desa);

        return view('Admin/Desa/v-datasurat', $data);
    }

    public function cek_dokumen_permohonan($id_permohonan)
    {
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);
        if (!$permohonan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permohonan tidak ditemukan.');
        }
        $dokumenPendukung = $this->Modeldokumen->getDokumenByPermohonan($id_permohonan);
        $data = [
            'permohonan' => $permohonan,
            'dokumenPendukung' => $dokumenPendukung
        ];

        return view('Admin/Desa/v-cek-dokumen', $data);
    }

    public function terima_berkas_permohonan($id_permohonan)
    {
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);
        if (!$permohonan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permohonan tidak ditemukan.');
        }
        $this->Modelpermohonan->updateStatus($id_permohonan, 2);
        session()->setFlashdata('success', 'Permohonan berhasil diverifikasi.');
        log_activity('Memverifikasi Permohonan Dengan ID :' . $id_permohonan);
        return redirect()->to(base_url('daftar-pengajuan'));
    }

    public function tolak_berkas_permohonan()
    {
        $id_permohonan = $this->request->getPost('id_permohonan');
        $alasan_penolakan = $this->request->getPost('alasan_penolakan');

        if (!$id_permohonan || !$alasan_penolakan) {
            return redirect()->back()->with('error', 'ID permohonan dan alasan penolakan wajib diisi.');
        }
        $this->Modelpermohonan->update($id_permohonan, [
            'id_status' => 6,
            'alasan_penolakan' => $alasan_penolakan,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        log_activity('Menolak Permohonan Dengan ID :' . $id_permohonan);
        session()->setFlashdata('success', 'Permohonan berhasil Ditolak!.');
        return redirect()->to(base_url('daftar-pengajuan'));
    }

    public function data_warga()
    {
        $id_desa = session()->get('id_desa');
        $desa = $this->Modeldesa->find($id_desa);
        $warga = $this->Modeluser
            ->where('id_desa', $id_desa)
            ->where('role', 3)
            ->findAll();
        $data = [
            'warga' => $warga,
            'nama_desa' => $desa['nama_desa'] ?? 'Desa Tidak Diketahui',
        ];

        return view('Admin/Desa/v-data-warga', $data);
    }

    public function delete($id_user)
    {
        if ($this->Modeluser->deleteUser($id_user)) {
            return redirect()->back()->with('success', 'Data warga berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data warga.');
        }
    }


    public function laporan_permohonan()
    {
        $id_desa = session()->get('id_desa');
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $desa = $this->Modeldesa->getDesaById($id_desa);
        $permohonan = $this->Modelpermohonan->getLaporanSurat($id_desa, $bulan, $tahun);

        $data = [
            'desa' => $desa,
            'permohonan' => $permohonan,
            'bulan' => $bulan,
            'tahun' => $tahun
        ];
        return view('Admin/Desa/v-laporan', $data);
    }
}
