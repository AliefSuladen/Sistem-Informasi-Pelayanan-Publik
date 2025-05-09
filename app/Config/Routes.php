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


$routes->get('profil', 'Admin::profil');
$routes->post('update-profil', 'Admin::update_profil');



$routes->get('masyarakat', 'Admin::masyarakat_dashboard');
$routes->get('admin-desa', 'Admin::desa_dashboard');
$routes->get('admin-kecamatan', 'Admin::kecamatan_dashboard');


$routes->get('daftar-pengajuan-surat', 'Kecamatan::index');
$routes->get('kecamatan_cek-dokumen/(:num)', 'Admin::cek_dokumen/$1');
$routes->post('kecamatan-validasi-berkas', 'Admin::validasi_berkas');
$routes->post('kecamatan-simpan-surat', 'Admin::simpan_surat');


$routes->get('daftar-pengajuan', 'Desa::data_surat');
$routes->get('data-warga', 'Desa::data_warga');
$routes->get('desa_cek-dokumen/(:num)', 'Desa::cek_dokumen/$1');
$routes->post('desa/terima-berkas/(:num)', 'Desa::terima_berkas/$1');
$routes->post('desa/tolak-berkas/(:num)', 'Desa::tolak_berkas/$1');


$routes->get('masyarakat-download/(:num)', 'Masyarakat::download/$1');
$routes->get('pengajuan-surat', 'Masyarakat::pengajuan_Surat');
$routes->post('simpan-pengajuan', 'Masyarakat::simpan_Pengajuan');
$routes->get('masyarakat-penolakan/(:num)', 'Masyarakat::detail_Penolakan/$1');
