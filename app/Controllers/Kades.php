<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeldokumen;
use App\Models\Modeluser;
use App\Models\Modeldesa;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;


class Kades extends BaseController
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

        return view('Admin/v-kades-dashboard', $data);
    }

    public function data_permohonan()
    {

        $id_desa = session()->get('id_desa');

        if (!$id_desa) {
            return redirect()->to('/login');
        }

        $data['permohonan'] = $this->Modelpermohonan->getPermohonanByDesa($id_desa, 2);

        return view('Admin/Desa/v-datasurat-warga', $data);
    }

    public function cek_dokumen_permohonan($id_permohonan)
    {
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);
        if (!$permohonan) {
            return redirect()->back()->with('error', 'Data permohonan tidak ditemukan.');
        }
        $dokumenPendukung = $this->Modeldokumen->getDokumenByPermohonan($id_permohonan);

        $data = [
            'permohonan' => $permohonan,
            'dokumenPendukung' => $dokumenPendukung
        ];

        return view('Admin/Desa/v-kades-cek-dokumen', $data);
    }

    public function create_permohonan_surat()
    {
        $id_permohonan = $this->request->getPost('id_permohonan');
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);

        if (!$permohonan) {
            return redirect()->back()->with('error', 'Permohonan tidak ditemukan.');
        }
        if (empty($permohonan['nomor_surat'])) {
            $nomorSurat = $this->Modelpermohonan->generateNomorSurat($permohonan['id_jenis']);
            $this->Modelpermohonan->update($id_permohonan, [
                'nomor_surat' => $nomorSurat,
                'status'      => 'Selesai'
            ]);
            $permohonan['nomor_surat'] = $nomorSurat;
        }

        $template_path = [
            1 => 'Admin/Template/sktm',
            2 => 'Admin/Template/domisili',
            3 => 'Admin/Template/kelahiran',
            4 => 'Admin/Template/kematian',
            5 => 'Admin/Template/skck',
            6 => 'Admin/Template/kehilangan',
            7 => 'Admin/Template/keterangan_usaha',
            8 => 'Admin/Template/pengantar_pindah',
        ];

        $id_jenis = $permohonan['id_jenis'];
        if (!isset($template_path[$id_jenis])) {
            return redirect()->back()->with('error', 'Template surat tidak ditemukan.');
        }

        $template = $template_path[$id_jenis];
        $logoPath = FCPATH . 'uploads/logo.jpg';
        $logoSrc = '';
        if (file_exists($logoPath)) {
            $logoSrc = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath));
        }
        $urlVerifikasi = base_url('verifikasi?id=' . $id_permohonan);
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($urlVerifikasi)
            ->size(120)
            ->margin(5)
            ->build();

        $qrCodeDataUri = $result->getDataUri();
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view($template, [
            'permohonan' => $permohonan,
            'logoSrc'    => $logoSrc,
            'qrCode'     => $qrCodeDataUri
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $filename = strtoupper(str_replace(' ', '_', $permohonan['surat'])) . '_' . $permohonan['nama_user'] . '_' . time() . '.pdf';

        file_put_contents('./uploads/dokumen/temp_' . $filename, $output);
        session()->set('filename', $filename);
        session()->set('id_permohonan', $id_permohonan);

        return $this->response->setContentType('application/pdf')->setBody($output);
    }

    public function terbitkan_surat()
    {
        $filename = session()->get('filename');
        $id_permohonan = session()->get('id_permohonan');

        if (!$filename || !$id_permohonan) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan surat.');
        }

        rename('./uploads/dokumen/temp_' . $filename, './uploads/dokumen/' . $filename);
        $this->Modelpermohonan->update($id_permohonan, [
            'file_surat' => $filename,
            'id_status' => 3
        ]);

        session()->remove(['filename', 'id_permohonan']);

        return redirect()->to('/daftar-pengajuan-warga')->with('success', 'Surat berhasil dicetak dan disimpan.');
    }
}
