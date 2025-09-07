<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeljenissurat;
use App\Models\Modeldokumen;


class Masyarakat extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldokumen = new Modeldokumen();
        $this->Modeljenissurat = new Modeljenissurat();
    }
    public function download($id_permohonan)
    {
        $permohonan = $this->Modelpermohonan->getFileSurat($id_permohonan);

        $filePath = './uploads/dokumen/' . $permohonan['file_surat'];

        if (!file_exists(FCPATH . $filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return redirect()->to(base_url($filePath));
    }
    public function pengajuan_Surat()
    {
        $data['jenis_surat'] = $this->Modeljenissurat->getAllJenisSurat();
        return view('Admin/Masyarakat/v-pengajuan-surat', $data);
    }

    public function simpan_pengajuan()
    {
        $id_user  = session()->get('id_user');
        $id_jenis = $this->request->getPost('id_jenis');

        // Data dasar permohonan
        $permohonanData = [
            'id_user'    => $id_user,
            'id_jenis'   => $id_jenis,
            'id_status'  => 1, // Status awal: diajukan
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Tambahan data berdasarkan jenis surat
        switch ($id_jenis) {
            case 1: // SKTM
                break;
            case 2: // Domisili
                break;
            case 3: // Kelahiran
                $permohonanData['nama_anak'] = $this->request->getPost('nama_anak');
                $permohonanData['tempat_lahir'] = $this->request->getPost('tempat_lahir');
                $permohonanData['tanggal_lahir'] = $this->request->getPost('tanggal_lahir');
                $permohonanData['nama_ayah'] = $this->request->getPost('nama_ayah');
                $permohonanData['nama_ibu'] = $this->request->getPost('nama_ibu');
                break;
            case 4: // Kematian
                $permohonanData['nama_alm'] = $this->request->getPost('nama_almarhum');
                $permohonanData['nik_alm'] = $this->request->getPost('nik_almarhum');
                $permohonanData['ttl_alm'] = $this->request->getPost('ttl_alm');
                $permohonanData['kelamin_alm'] = $this->request->getPost('kelamin_alm');
                $permohonanData['agama_alm'] = $this->request->getPost('agama_alm');
                $permohonanData['pekerjaan_alm'] = $this->request->getPost('pekerjaan_alm');
                $permohonanData['alamat_alm'] = $this->request->getPost('alamat_alm');
                $permohonanData['tempat_kematian'] = $this->request->getPost('tempat');
                $permohonanData['tanggal_kematian'] = $this->request->getPost('tgl_wafat');
                $permohonanData['sebab_kematian'] = $this->request->getPost('sebab_kematian');
                break;
            case 5: // SKCK
                $permohonanData['tujuan_skck'] = $this->request->getPost('tujuan_skck');
                break;
            case 6: // kehilangan
                $permohonanData['brg_hilang'] = $this->request->getPost('brg_hilang');
                $permohonanData['tgl_hilang'] = $this->request->getPost('tgl_hilang');
                $permohonanData['tempat_kehilangan'] = $this->request->getPost('tempat_kehilangan');
                break;
            case 7:
                $permohonanData['nama_usaha'] = $this->request->getPost('nama_usaha');
                $permohonanData['jenis_usaha'] = $this->request->getPost('jenis_usaha');
                $permohonanData['alamat_usaha'] = $this->request->getPost('alamat_usaha');
                break;
            case 8: //pengantar pindah
                $permohonanData['nomor_kk'] = $this->request->getPost('nomor_kk');
                $permohonanData['nama_kk'] = $this->request->getPost('nama_kk');
                $permohonanData['alamat_tujuan'] = $this->request->getPost('alamat_tujuan');
                $permohonanData['desa_tujuan'] = $this->request->getPost('desa_tujuan');
                $permohonanData['kec_tujuan'] = $this->request->getPost('kec_tujuan');
                $permohonanData['kab_tujuan'] = $this->request->getPost('kab_tujuan');
                $permohonanData['jumlah_pindah'] = $this->request->getPost('jumlah_pindah');
                break;
        }

        // Simpan ke database
        $this->Modelpermohonan->insert($permohonanData);
        $id_permohonan = $this->Modelpermohonan->insertID();

        // Proses upload dokumen
        $files = $this->request->getFiles();
        $uploadPath = 'uploads/dokumen/';
        $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];

        if (isset($files['dokumen'])) {
            foreach ($files['dokumen'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $extension = $file->getExtension();
                    if (in_array($extension, $allowedTypes)) {
                        $fileName = $file->getRandomName();
                        $file->move($uploadPath, $fileName);

                        $this->Modeldokumen->save([
                            'id_permohonan' => $id_permohonan,
                            'nama_dokumen' => $file->getClientName(),
                            'file_dokumen' => $fileName
                        ]);
                    } else {
                        session()->setFlashdata('error', 'Tipe file tidak diizinkan: ' . $file->getClientName());
                        return redirect()->back();
                    }
                }
            }
        }

        session()->setFlashdata('success', 'Pengajuan surat berhasil diajukan.');
        return redirect()->to('masyarakat');
    }
    public function detail_Penolakan($id_permohonan)
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

        return view('Admin/Masyarakat/v-detail-penolakan', $data);
    }
}
