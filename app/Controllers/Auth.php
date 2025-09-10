<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelauth;



class Auth extends BaseController
{
    public function __construct()
    {
        $this->Modelauth = new Modelauth();
        helper('form');
    }
    public function index() {}

    public function login()
    {
        echo view('v-login');
    }

    public function cek_login()
    {
        // Validasi input
        if ($this->validate([
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!',
                    'valid_email' => 'Harus Menggunakan @'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!',
                ]
            ]
        ])) {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');


            $cek_login = $this->Modelauth->login($email, $password);

            if ($cek_login) {
                session()->set('id_user', $cek_login['id_user']);
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('email', $cek_login['email']);
                session()->set('id_desa', $cek_login['id_desa']);
                session()->set('role', $cek_login['role']);
                session()->set('foto', $cek_login['foto']);


                switch ($cek_login['role']) {
                    case 'Admin Kecamatan':
                        return redirect()->to('admin-kecamatan');
                        break;
                    case 'Admin Desa':
                        return redirect()->to('admin-desa');
                        break;
                    case 'Masyarakat':
                        return redirect()->to('masyarakat');
                        break;
                    case 'Kepala Desa':
                        return redirect()->to('kades');
                        break;
                    default:
                        session()->setFlashdata('pesan', 'Role tidak dikenali');
                        return redirect()->to('login');
                }
            } else {

                session()->setFlashdata('pesan', 'Email atau Password Salah!');
                return redirect()->to('login');
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('login');
        }
    }
    public function logout()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('id_desa');
        session()->remove('role');

        session()->remove('foto');

        session()->setFlashdata('pesan', 'Logout sukses!');

        return redirect()->to('login');
    }
}
