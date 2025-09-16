<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelberita;



class Berita extends BaseController
{
    public function __construct()
    {
        $this->Modelberita = new Modelberita();
    }
    public function data_berita()
    {
        $id_user = session()->get('id_user');

        $data = [
            'title' => 'Berita Saya',
            'berita' => $this->Modelberita->getAllBerita($id_user)
        ];

        return view('Admin/Berita/v-data-berita', $data);
    }

    public function tambah_berita()
    {
        $data = [
            'title' => 'Tambah Berita'
        ];

        return view('Admin/Berita/v-create-berita', $data);
    }

    public function simpan_berita()
    {
        $id_user = session()->get('id_user');
        $judul   = $this->request->getPost('judul');
        $isi     = $this->request->getPost('isi');

        if (empty($judul) || empty($isi)) {
            return redirect()->back()->withInput()->with('error', 'Judul dan isi berita wajib diisi!');
        }

        $slug = url_title($judul, '-', true);
        $data = [
            'id_user'    => $id_user,
            'judul'      => $judul,
            'slug'       => $slug,
            'isi'        => $isi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insert berita ke database
        $this->Modelberita->simpanBerita($data);
        $id_berita = $this->Modelberita->insertID();
        $files = $this->request->getFiles();
        $uploadPath = 'uploads/berita/';
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (isset($files['gambar'])) {
            foreach ($files['gambar'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $extension = $file->getExtension();
                    if (in_array($extension, $allowedTypes)) {
                        $fileName = $file->getRandomName();
                        $file->move($uploadPath, $fileName);
                        $uploadedImages[] = $fileName;
                    } else {
                        session()->setFlashdata('error', 'Tipe file tidak diizinkan: ' . $file->getClientName());
                        return redirect()->back()->withInput();
                    }
                }
            }

            if (!empty($uploadedImages)) {
                $this->Modelberita->update($id_berita, ['gambar' => json_encode($uploadedImages)]);
            }
        }

        session()->setFlashdata('success', 'Berita berhasil ditambahkan!');
        return redirect()->to(base_url('data-berita'))->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = $this->Modelberita->find($id);

        if (!$berita) {
            return redirect()->to('admin/berita')->with('error', 'Berita tidak ditemukan.');
        }

        return view('Admin/Berita/v-edit-berita', [
            'berita' => $berita
        ]);
    }

    public function update($id)
    {
        $beritaLama = $this->Modelberita->find($id);
        if (!$beritaLama) {
            return redirect()->back()->with('error', 'Berita tidak ditemukan');
        }

        $judul = $this->request->getPost('judul');
        $isi   = $this->request->getPost('isi');

        $rules = [
            'judul' => 'required|min_length[3]',
            'isi'   => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $data = [
            'judul'      => $judul,
            'isi'        => $isi,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle upload gambar baru
        $files = $this->request->getFiles();
        $uploadedImages = [];

        if (isset($files['gambar'])) {
            $hasNewFile = false;
            $uploadPath = 'uploads/berita/';
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            foreach ($files['gambar'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $hasNewFile = true;
                    $extension = $file->getExtension();
                    if (in_array($extension, $allowedTypes)) {
                        $fileName = $file->getRandomName();
                        $file->move($uploadPath, $fileName);
                        $uploadedImages[] = $fileName;
                    } else {
                        return redirect()->back()->withInput()->with('error', 'Tipe file tidak diizinkan: ' . $file->getClientName());
                    }
                }
            }

            if ($hasNewFile) {
                // Hapus gambar lama dari folder
                $oldImages = !empty($beritaLama['gambar']) ? json_decode($beritaLama['gambar'], true) : [];
                if (is_array($oldImages)) {
                    foreach ($oldImages as $img) {
                        $filePath = FCPATH . 'uploads/berita/' . $img;
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
                // Set gambar baru
                $data['gambar'] = json_encode($uploadedImages);
            }
        }

        $this->Modelberita->update($id, $data);

        return redirect()->to(base_url('data-berita'))->with('success', 'Berita berhasil diupdate');
    }


    public function delete($id)
    {
        $berita = $this->Modelberita->find($id);

        if (!$berita) {
            return redirect()->back()->with('error', 'Berita tidak ditemukan');
        }

        // Hapus gambar dari folder jika ada
        if (!empty($berita['gambar'])) {
            $images = json_decode($berita['gambar'], true);
            if (is_array($images)) {
                foreach ($images as $img) {
                    $filePath = FCPATH . 'uploads/berita/' . $img;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
        }

        // Hapus data dari database
        $this->Modelberita->delete($id);

        return redirect()->to(base_url('data-berita'))->with('success', 'Berita berhasil dihapus');
    }
}
