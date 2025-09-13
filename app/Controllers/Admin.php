<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeluser;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeluser = new Modeluser();
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
        $userLama = $this->Modeluser->getUser($id);

        $data = [];
        $inputFields = ['nama_user', 'email', 'pekerjaan', 'agama', 'alamat'];
        foreach ($inputFields as $field) {
            $value = $this->request->getPost($field);
            if (!is_null($value) && $value !== '') {
                $data[$field] = $value;
            }
        }

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = ($password);
        }
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profil/', $newName);
            $data['foto'] = $newName;

            if (!empty($userLama['foto']) && file_exists(FCPATH . 'uploads/profil/' . $userLama['foto'])) {
                unlink(FCPATH . 'uploads/profil/' . $userLama['foto']);
            }
            session()->set('foto', $newName);
        }

        $this->Modeluser->set($data)->where('id_user', $id)->update();

        if ($this->Modeluser->db->affectedRows() > 0) {
            session()->setFlashdata('success', 'Profil berhasil diperbarui.');
        } else {
            session()->setFlashdata('info', 'Tidak ada perubahan pada data.');
        }
        $userBaru = $this->Modeluser->getUser($id);
        session()->set('nama_user', $userBaru['nama_user']);

        return redirect()->to(base_url('profil'));
    }

    public function verifikasi_keaslian_surat()
    {
        $id_permohonan = $this->request->getGet('id');

        if (!$id_permohonan) {
            return view('Admin/verifikasi_surat', [
                'status' => '❌ Tidak Valid',
                'surat' => null
            ]);
        }
        $surat = $this->Modelpermohonan->getPermohonanById($id_permohonan);
        if (!$surat || empty($surat['file_surat'])) {
            $status = '❌ Tidak Valid';
        } else {
            $status = '✅ Valid';
        }
        return view('Admin/verifikasi_surat', [
            'surat' => $surat,
            'status' => $status
        ]);
    }
}
