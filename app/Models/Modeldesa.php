<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeldesa extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id_desa';
    protected $allowedFields = ['nama_desa'];
}
