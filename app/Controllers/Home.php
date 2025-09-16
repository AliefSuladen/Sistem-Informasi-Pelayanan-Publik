<?php

namespace App\Controllers;

use App\Models\Modeljenissurat;
use App\Models\Modelpermohonan;
use App\Models\Modeluser;
use App\Models\Modeldesa;
use App\Models\Modeldokumen;
use App\Models\Modelberita;



class Home extends BaseController
{
    public function __construct()
    {
        $this->Modeljenissurat = new Modeljenissurat();
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeluser = new Modeluser();
        $this->Modeldesa = new Modeldesa();
        $this->Modeldokumen = new Modeldokumen();
        $this->Modelberita = new Modelberita();
    }
    public function index()
    {
        $berita = $this->Modelberita->orderBy('created_at', 'DESC')->findAll(3);
        $layanan = $this->Modeljenissurat->orderBy('id_jenis', 'ASC')->findAll(4);

        $data = [
            'berita' => $berita,
            'layanan' => $layanan,
        ];
        return view('v-home', $data);
    }
    public function tentang()
    {
        return view('Home/v-profil');
    }
    public function berita()
    {
        $perPage = 9; // berita per halaman
        $currentPage = $this->request->getVar('page') ?? 1;

        $data = [
            'berita' => $this->Modelberita->orderBy('created_at', 'DESC')
                ->paginate($perPage),
            'pager' => $this->Modelberita->pager,
            'currentPage' => $currentPage
        ];

        return view('Home/v-berita', $data);
    }

    public function detail_berita($slug)
    {
        $berita = $this->Modelberita->getBeritaDetail($slug);

        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }

        $data = [
            'berita' => $berita
        ];

        return view('Home/v-detail-berita', $data);
    }

    public function formPengajuan()
    {

        $data['jenis_surat'] = $this->Modeljenissurat->getAllJenisSurat();
        $data['desa'] = $this->Modeldesa->getAllDesa();

        return view('Home/v-pengajuan', $data);
    }


    public function ajukanSurat()
    {
        $nik = $this->request->getPost('nik');
        $nama_user = $this->request->getPost('nama_user');
        $email = $this->request->getPost('email');
        $id_desa = $this->request->getPost('id_desa');
        $id_jenis = $this->request->getPost('id_jenis');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $agama = $this->request->getPost('agama');
        $kelamin = $this->request->getPost('kelamin');
        $alamat = $this->request->getPost('alamat');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $tgl_lahir = $this->request->getPost('tgl_lahir');

        // Cek apakah NIK sudah terdaftar
        $existingUser = $this->Modeluser->where('email', $email)->first();

        if ($existingUser) {
            // Email cocok, pastikan NIK-nya juga cocok
            if ($existingUser['nik'] !== $nik) {
                session()->setFlashdata('error', 'Email sudah digunakan oleh NIK lain. Silakan login.');
                return redirect()->back()->withInput();
            }

            $id_user = $existingUser['id_user'];
        } else {
            // Cek jika NIK sudah dipakai user lain
            $nikSudahAda = $this->Modeluser->cekNik($nik);
            if ($nikSudahAda) {
                session()->setFlashdata('error', 'NIK sudah digunakan oleh pengguna lain.');
                return redirect()->back()->withInput();
            }

            // Buat user baru
            $newUserData = [
                'nama_user' => $nama_user,
                'email' => $email,
                'nik' => $nik,
                'id_desa' => $id_desa,
                'password' => 1234,
                'role' => 3,
                'pekerjaan' => $pekerjaan,
                'agama' => $agama,
                'kelamin' => $kelamin,
                'alamat' => $alamat,
                'tempat_lahir' => $tempat_lahir,
                'tgl_lahir' => $tgl_lahir,
            ];
            $this->Modeluser->insert($newUserData);
            $id_user = $this->Modeluser->insertID();
        }


        // Simpan data permohonan surat
        $permohonanData = [
            'id_user'   => $id_user,
            'id_jenis'  => $id_jenis,
            'id_status' => 1,
            'id_desa'   => $id_desa,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // **Tambahkan data sesuai jenis surat**
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

        // Simpan permohonan ke database
        $id_permohonan = $this->Modelpermohonan->simpanPermohonan($permohonanData);

        // Proses upload dokumen
        $files = $this->request->getFiles();
        $uploadPath = 'uploads/dokumen/';
        $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];

        if ($files) {
            foreach ($files['dokumen'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $extension = $file->getExtension();
                    if (in_array($extension, $allowedTypes)) {
                        $fileName = $file->getRandomName();
                        if ($file->move($uploadPath, $fileName)) {
                            $this->Modeldokumen->save([
                                'id_permohonan' => $id_permohonan,
                                'nama_dokumen' => $file->getClientName(),
                                'file_dokumen' => $fileName
                            ]);
                        } else {
                            session()->setFlashdata('error', 'Gagal memindahkan file: ' . $file->getClientName());
                            return redirect()->back();
                        }
                    } else {
                        session()->setFlashdata('error', 'Tipe file tidak diizinkan: ' . $file->getClientName());
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('error', 'File tidak valid atau sudah dipindahkan: ' . $file->getClientName());
                    return redirect()->back();
                }
            }
        }

        return redirect()->to('login')->with('pesan', 'Akun berhasil dibuat. Silakan login Dengan Password 1234 !!!');
    }
}
