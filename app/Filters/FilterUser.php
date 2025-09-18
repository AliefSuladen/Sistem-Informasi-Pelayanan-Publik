<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // cek login
        if (!$session->get('role')) {
            return redirect()->to('/login')->with('pesan', 'Silakan login dulu.');
        }

        // cek role dari argumen
        if ($arguments && !in_array($session->get('role'), $arguments)) {
            return service('response')
                ->setStatusCode(403)
                ->setBody(view('errors/erorr'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
