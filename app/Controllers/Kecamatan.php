<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelpermohonan;

class Kecamatan extends BaseController
{
    public function __construct()
    {
        $this->Modelpermohonan = new Modelpermohonan();
    }
    public function index()
    {

        $data['permohonan'] = $this->Modelpermohonan->getAllPermohonan();

        return view('Admin/Kecamatan/v-datasurat', $data);
    }
}
