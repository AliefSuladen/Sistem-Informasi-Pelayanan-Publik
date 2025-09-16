<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeldesa;
use App\Models\Modeluser;
use App\Models\Modeldokumen;
use App\Models\Modeljenissurat;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class Kecamatan extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldesa = new Modeldesa();
        $this->Modeluser = new Modeluser();
        $this->Modeljenissurat = new Modeljenissurat();
        $this->Modeldokumen = new Modeldokumen();
    }
    public function dashboard()
    {

        $data = [
            'total_permohonan'   => count($this->Modelpermohonan->findAll()),
            'statistik_status'   => $this->Modelpermohonan->getStatistikGlobal(),
            'statistik_jenis'    => $this->Modelpermohonan->getJumlahJenisSuratGlobal(),
            'permohonan_terbaru' => array_slice($this->Modelpermohonan->getAllPermohonan(), 0, 5),
        ];

        return view('Admin/v-kec-dashboard', $data);
    }
    public function data_permohonan()
    {
        $permohonan = $this->Modelpermohonan->getPermohonanLegalisasi();

        $data = [
            'permohonan' => $permohonan
        ];

        return view('Admin/Kecamatan/v-datasurat', $data);
    }

    public function cek_dokumen_permohonan($id_permohonan)
    {
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);
        $dokumenPendukung = $this->Modeldokumen->getDokumenByPermohonan($id_permohonan);
        $data = [
            'permohonan' => $permohonan,
            'dokumenPendukung' => $dokumenPendukung
        ];

        return view('Admin/Kecamatan/v-cek-dokumen', $data);
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
        session()->setFlashdata('success', 'Permohonan berhasil Ditolak!.');
        return redirect()->to(base_url('daftar-pengajuan-surat'));
    }


    public function create_permohonan_legalisasi()
    {
        $id_permohonan = $this->request->getPost('id_permohonan');
        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);

        if (!$permohonan) {
            return redirect()->back()->with('error', 'Permohonan tidak ditemukan.');
        }

        $fileDesa = FCPATH . 'uploads/dokumen/' . $permohonan['file_surat'];
        if (!file_exists($fileDesa)) {
            return redirect()->back()->with('error', 'File surat desa tidak ditemukan.');
        }

        $nomorSuratCamat = $this->Modelpermohonan->generateNomorSuratCamat($permohonan['id_jenis']);
        $logoPath = FCPATH . 'uploads/logo.jpg';
        $logoSrc = file_exists($logoPath) ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath)) : '';

        $ttdCamatPath = FCPATH . 'uploads/TTD_Camat.png';
        $ttdCamatSrc = file_exists($ttdCamatPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($ttdCamatPath)) : '';
        $urlVerifikasi = base_url('verifikasi?id=' . $id_permohonan);
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($urlVerifikasi)
            ->size(120)
            ->margin(5)
            ->build();
        $qrCodeDataUri = $result->getDataUri();

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
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view($template, [
            'permohonan'         => $permohonan,
            'logoSrc'            => $logoSrc,
            'qrCode'             => $qrCodeDataUri,
            'ttdCamatSrc'        => $ttdCamatSrc,
            'nomorSuratCamat'    => $nomorSuratCamat,
            'isPreviewCamat'     => true,
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $filename = strtoupper(str_replace(' ', '_', $permohonan['surat'])) . '_' . $permohonan['nama_user'] . '_CAMAT_' . time() . '.pdf';
        file_put_contents('./uploads/dokumen/temp_' . $filename, $output);
        session()->set('filename', $filename);
        session()->set('id_permohonan', $id_permohonan);

        return $this->response->setContentType('application/pdf')->setBody($output);
    }

    public function terbitkan_legalisasi_surat()
    {
        $filename = session()->get('filename');
        $id_permohonan = session()->get('id_permohonan');

        if (!$filename || !$id_permohonan) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan surat.');
        }

        rename('./uploads/dokumen/temp_' . $filename, './uploads/dokumen/' . $filename);

        $this->Modelpermohonan->update($id_permohonan, [
            'file_surat' => $filename,
            'id_status'  => 5
        ]);

        session()->remove(['filename', 'id_permohonan']);
        return redirect()->to('/daftar-pengajuan-surat')->with('success', 'Surat berhasil diterbitkan dan dapat diunduh masyarakat.');
    }

    public function data_desa()
    {

        $data['desa'] = $this->Modeldesa->get_user_terdaftar();
        return view('Admin/Kecamatan/v-data-desa', $data);
    }

    public function data_admin_desa()
    {
        $data['admin_desa'] = $this->Modeldesa->get_admin_desa();
        $data['daftar_desa'] = $this->Modeldesa->getAllDesa();
        return view('Admin/Kecamatan/v-data-admin-desa', $data);
    }

    public function create_admin_desa()
    {
        $nama = $this->request->getPost('nama_user');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $id_desa = $this->request->getPost('id_desa');
        $foto = $this->request->getFile('foto');
        if (!$foto->isValid() || $foto->hasMoved()) {
            session()->setFlashdata('error', 'Foto profil wajib diunggah.');
            return redirect()->back()->withInput();
        }

        $existing = $this->Modeluser->where('email', $email)->first();
        if ($existing) {
            session()->setFlashdata('error', 'Email sudah digunakan.');
            return redirect()->back()->withInput();
        }
        $namaFoto = $foto->getRandomName();
        $foto->move('uploads/profil', $namaFoto);
        $this->Modeluser->insert([
            'nama_user' => $nama,
            'email' => $email,
            'password' => $password,
            'id_desa' => $id_desa,
            'role' => 2,
            'foto' => $namaFoto,
        ]);

        session()->setFlashdata('success', 'Admin desa berhasil ditambahkan.');
        return redirect()->to('kecamatan-data-admin');
    }

    public function data_jenis_surat()
    {
        $data['jenis_surat'] = $this->Modeljenissurat->getAllJenisSurat();
        return view('Admin/Kecamatan/v-jenis-surat', $data);
    }
    public function create_jenis_surat()
    {
        $nama = $this->request->getPost('surat');

        if (!$nama) {
            session()->setFlashdata('error', ' jenis surat wajib diisi.');
            return redirect()->back()->withInput();
        }

        $model = new Modeljenissurat();
        $model->insert([
            'surat' => $nama
        ]);

        session()->setFlashdata('success', 'Jenis surat berhasil ditambahkan.');
        return redirect()->to('kecamatan-jenis-surat');
    }

    public function hapus_jenis_surat($id_jenis)
    {
        $jenis = $this->Modeljenissurat->find($id_jenis);
        if (!$jenis) {
            session()->setFlashdata('error', 'Data tidak ditemukan.');
            return redirect()->back();
        }

        $this->Modeljenissurat->delete($id_jenis);

        session()->setFlashdata('success', 'Jenis surat berhasil dihapus.');
        return redirect()->to('kecamatan-jenis-surat');
    }

    public function laporan()
    {
        $tahun = $this->request->getGet('tahun');
        $bulan = $this->request->getGet('bulan');

        $data = [
            'laporan' => $this->Modelpermohonan->getLaporan($tahun, $bulan),
            'tahun'   => $tahun,
            'bulan'   => $bulan,
            'jenis_surat' => $this->Modeljenissurat->getAllJenisSurat(),
        ];

        return view('Admin/Kecamatan/v-laporan', $data);
    }
}
