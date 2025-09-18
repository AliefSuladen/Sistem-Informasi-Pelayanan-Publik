<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelactivity extends Model
{
    protected $table      = 'activity_log';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'role',
        'activity',
        'ip_address',
        'user_agent',
        'created_at'
    ];
    public function getLog()
    {
        return $this->select('activity_log.*, user.nama_user')
            ->join('user', 'user.id_user = activity_log.id_user', 'left')
            ->orderBy('activity_log.created_at', 'DESC')
            ->findAll();
    }
}
