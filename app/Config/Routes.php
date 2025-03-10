<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('login', 'Auth::login'); // Menampilkan form login
$routes->post('login/process', 'Auth::cek_login'); // Proses login
$routes->get('logout', 'Auth::logout'); // Logout user
$routes->get('formpengajuan', 'Home::formPengajuan');
$routes->post('postpengajuan', 'Home::ajukanSurat');


$routes->get('admin-desa', 'Admin::desa_dashboard');
$routes->get('masyarakat', 'Admin::masyarakat');


$routes->get('admin-kecamatan', 'Admin::index');
$routes->get('daftar-pengajuan-surat', 'Kecamatan::index');
$routes->get('kecamatan_cek-dokumen/(:num)', 'Admin::cek_dokumen/$1');
$routes->post('kecamatan-validasi-berkas', 'Admin::validasi_berkas');
$routes->post('kecamatan-simpan-surat', 'Admin::simpan_surat');






$routes->get('daftar-pengajuan', 'Desa::index');
$routes->get('desa_cek-dokumen/(:num)', 'Desa::cek_dokumen/$1');
$routes->post('desa/terima-berkas/(:num)', 'Desa::terima_berkas/$1');
