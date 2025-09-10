<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;
use App\Models\Modeldokumen;
use App\Models\Modeluser;
use App\Models\Modeldesa;


class Kades extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
        $this->Modeldokumen = new Modeldokumen();
        $this->Modeluser = new Modeluser();
        $this->Modeldesa = new Modeldesa();
    }

    public function data_surat()
    {

        $id_desa = session()->get('id_desa');

        if (!$id_desa) {
            return redirect()->to('/login');
        }

        $data['permohonan'] = $this->Modelpermohonan->getPermohonanByDesa($id_desa, 2);

        return view('Admin/Desa/v-datasurat-warga', $data);
    }
}
