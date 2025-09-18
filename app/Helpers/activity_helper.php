<?php

use App\Models\Modelactivity;

if (!function_exists('log_activity')) {
    function log_activity($activity)
    {
        $session = session();
        $logModel = new Modelactivity();

        $logModel->insert([
            'id_user'    => $session->get('id_user') ?? null,
            'activity'   => $activity,
            'ip_address' => service('request')->getIPAddress(),
            'user_agent' => service('request')->getUserAgent(),
        ]);
    }
}
