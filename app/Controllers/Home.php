<?php

namespace App\Controllers;

use App\Models\Modeljenissurat;
use App\Models\Modelpermohonan;
use App\Models\Modeluser;
use App\Models\Modeldesa;
use App\Models\Modeldokumen;



class Home extends BaseController
{
    public function __construct()
    {
        // Load model secara otomatis
        $this->Modeljenissurat = new Modeljenissurat();
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeluser = new Modeluser();
        $this->Modeldesa = new Modeldesa();
        $this->Modeldokumen = new Modeldokumen();
    }
    public function index()
    {
        return view('v-home');
    }

    public function formPengajuan()
    {
        $Modeljenissurat = new Modeljenissurat();
        $data['jenis_surat'] = $Modeljenissurat->findAll();
        $data['desa'] = $this->Modeldesa->findAll();

        return view('Home/v-pengajuan', $data);
    }


    public function ajukanSurat()
    {
        $nik = $this->request->getPost('nik');
        $nama_user = $this->request->getPost('nama_user');
        $email = $this->request->getPost('email');
        $id_desa = $this->request->getPost('id_desa');
        $id_jenis = $this->request->getPost('id_jenis');

        // Cek apakah NIK sudah terdaftar
        $existingUser = $this->Modeluser->where('nik', $nik)->first();
        if ($existingUser) {
            session()->setFlashdata('error', 'NIK sudah terdaftar. Silakan login.');
            return redirect()->back();
        }

        // Cek apakah email sudah terdaftar
        $existingEmail = $this->Modeluser->where('email', $email)->first();
        if (!$existingEmail) {
            // Jika user baru, simpan data ke tabel user
            $newUserData = [
                'nama_user' => $nama_user,
                'email' => $email,
                'nik' => $nik,
                'id_desa' => $id_desa,
                'password' => 1234,
                'role' => 3,
            ];
            $this->Modeluser->insert($newUserData);
            $id_user = $this->Modeluser->insertID();
        } else {
            $id_user = $existingEmail['id_user'];
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
                $permohonanData['alasan_sktm'] = $this->request->getPost('alasan');
                break;
            case 2: // Domisili
                $permohonanData['alamat_domisili'] = $this->request->getPost('alamat_domisili');
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
                $permohonanData['tempat_kematian'] = $this->request->getPost('tempat_kematian');
                $permohonanData['tanggal_kematian'] = $this->request->getPost('tanggal_wafat');
                $permohonanData['sebab_kematian'] = $this->request->getPost('sebab_kematian');
                break;
            case 5: // SKCK
                $permohonanData['tujuan_skck'] = $this->request->getPost('tujuan_skck');
                break;
            case 6: // Izin Usaha
            case 7: // Keterangan Usaha
                $permohonanData['nama_usaha'] = $this->request->getPost('nama_usaha');
                $permohonanData['jenis_usaha'] = $this->request->getPost('jenis_usaha');
                $permohonanData['alamat_usaha'] = $this->request->getPost('alamat_usaha');
                $permohonanData['modal_usaha'] = $this->request->getPost('modal_usaha');
                break;
        }

        // Simpan permohonan ke database
        $id_permohonan = $this->Modelpermohonan->insert($permohonanData);

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

        return redirect()->to('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
