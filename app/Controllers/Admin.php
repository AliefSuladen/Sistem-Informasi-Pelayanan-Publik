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


class Admin extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldokumen = new Modeldokumen();
        $this->Modeluser = new Modeluser();
        $this->Modeldesa = new Modeldesa();
    }
    public function kecamatan_dashboard()
    {

        return view('Admin/v-kec-dashboard');
    }
    public function masyarakat_dashboard()
    {

        $id_user = session()->get('id_user');

        $permohonan = $this->Modelpermohonan->getPermohonanByUser($id_user);

        $data = [
            'permohonan' => $permohonan,
        ];

        return view('Admin/v-mas-dashboard', $data);
    }

    public function desa_dashboard()
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


    public function profil()
    {
        $id_user = session()->get('id_user');

        $user = $this->Modeluser->getUser($id_user);

        $data = [
            'user' => $user,
        ];

        return view('Admin/v-profil', $data);
    }

    public function update_profil()
    {
        $id = session()->get('id_user');

        // Ambil data user lama untuk keperluan perbandingan atau hapus foto lama
        $userLama = $this->Modeluser->getUser($id);

        $data = [];

        // Cek dan isi field jika ada input
        $inputFields = ['nama_user', 'email', 'pekerjaan', 'agama', 'alamat'];
        foreach ($inputFields as $field) {
            $value = $this->request->getPost($field);
            if (!is_null($value) && $value !== '') {
                $data[$field] = $value;
            }
        }

        // Password jika diisi
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = ($password);
        }

        // Upload foto jika ada
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profil/', $newName);
            $data['foto'] = $newName;

            // Hapus foto lama jika ada
            if (!empty($userLama['foto']) && file_exists(FCPATH . 'uploads/profil/' . $userLama['foto'])) {
                unlink(FCPATH . 'uploads/profil/' . $userLama['foto']);
            }

            // Update foto di session
            session()->set('foto', $newName);
        }

        // Lakukan update
        $this->Modeluser->set($data)->where('id_user', $id)->update();

        // Cek apakah data berubah atau tidak
        if ($this->Modeluser->db->affectedRows() > 0) {
            session()->setFlashdata('success', 'Profil berhasil diperbarui.');
        } else {
            session()->setFlashdata('info', 'Tidak ada perubahan pada data.');
        }

        $userBaru = $this->Modeluser->getUser($id);
        session()->set('nama_user', $userBaru['nama_user']);

        return redirect()->to(base_url('profil'));
    }



    public function cek_dokumen($id_permohonan)
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

        return view('Admin/Kecamatan/v-cek-dokumen', $data);
    }

    public function validasi_berkas()
    {
        $id_permohonan = $this->request->getPost('id_permohonan');

        $permohonan = $this->Modelpermohonan->getPermohonanById($id_permohonan);

        if (!$permohonan) {
            return redirect()->back()->with('error', 'Permohonan tidak ditemukan.');
        }

        // Mapping ID Jenis Surat ke Template
        $template_path = [
            1 => 'Admin/Template/sktm',      // Surat Keterangan Tidak Mampu
            2 => 'Admin/Template/domisili',  // Surat Domisili
            3 => 'Admin/Template/kelahiran', // Surat Kelahiran
            4 => 'Admin/Template/kematian',  // Surat Kematian
            5 => 'Admin/Template/skck',      // Surat Pengantar SKCK
            6 => 'Admin/Template/izin_usaha', // Surat Izin Usaha
            7 => 'Admin/Template/keterangan_usaha', // Surat Keterangan Usaha
        ];

        $id_jenis = $permohonan['id_jenis'];
        if (!isset($template_path[$id_jenis])) {
            return redirect()->back()->with('error', 'Template surat tidak ditemukan.');
        }

        $template = $template_path[$id_jenis];

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);


        $html = view($template, ['permohonan' => $permohonan]);
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

    public function simpan_surat()
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

        return redirect()->to('/admin-kecamatan')->with('success', 'Surat berhasil dicetak dan disimpan.');
    }
}
