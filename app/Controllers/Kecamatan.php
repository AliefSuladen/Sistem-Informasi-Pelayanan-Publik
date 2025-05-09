<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeldesa;
use App\Models\Modeluser;
use App\Models\Modeljenissurat;

class Kecamatan extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldesa = new Modeldesa();
        $this->Modeluser = new Modeluser();
        $this->Modeljenissurat = new Modeljenissurat();
    }
    public function index()
    {

        $data['permohonan'] = $this->Modelpermohonan->getAllPermohonan();

        return view('Admin/Kecamatan/v-datasurat', $data);
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
    public function save_admin_desa()
    {
        $nama = $this->request->getPost('nama_user');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $id_desa = $this->request->getPost('id_desa');
        $foto = $this->request->getFile('foto');

        // Validasi foto wajib
        if (!$foto->isValid() || $foto->hasMoved()) {
            session()->setFlashdata('error', 'Foto profil wajib diunggah.');
            return redirect()->back()->withInput();
        }

        // Cek jika email sudah digunakan
        $existing = $this->Modeluser->where('email', $email)->first();
        if ($existing) {
            session()->setFlashdata('error', 'Email sudah digunakan.');
            return redirect()->back()->withInput();
        }

        // Simpan foto
        $namaFoto = $foto->getRandomName();
        $foto->move('uploads/profil', $namaFoto);

        // Simpan data ke database
        $this->Modeluser->insert([
            'nama_user' => $nama,
            'email' => $email,
            'password' => $password,
            'id_desa' => $id_desa,
            'role' => 2, // Admin Desa
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
    public function add_jenis_surat()
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
}
