<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('login', 'Auth::login');
$routes->post('login/process', 'Auth::cek_login');
$routes->get('logout', 'Auth::logout');
$routes->get('formpengajuan', 'Home::formPengajuan');
$routes->get('tentang', 'Home::tentang');
$routes->post('postpengajuan', 'Home::ajukanSurat');
$routes->get('berita', 'Home::berita');
$routes->get('detail-berita/(:segment)', 'Home::detail_berita/$1');



$routes->get('profil', 'Admin::profil');
$routes->post('update-profil', 'Admin::update_profil');
$routes->get('verifikasi', 'Admin::verifikasi_keaslian_surat');

$routes->get('masyarakat', 'Masyarakat::dashboard');
$routes->get('pengajuan-surat', 'Masyarakat::pengajuan_permohonan');
$routes->post('simpan-pengajuan', 'Masyarakat::simpan_pengajuan_permohonan');
$routes->get('masyarakat-penolakan/(:num)', 'Masyarakat::detail_Penolakan/$1');
$routes->get('masyarakat-ajukan-legalisasi/(:num)', 'Masyarakat::ajukan_permohonan_legalisasi/$1');
$routes->post('masyarakat-simpan-legalisasi', 'Masyarakat::simpan_permohonan_legalisasi');
$routes->get('masyarakat-download/(:num)', 'Masyarakat::download_surat/$1');

$routes->get('admin-desa', 'Desa::dashboard');
$routes->get('daftar-pengajuan', 'Desa::data_permohonan');
$routes->get('desa_cek-dokumen/(:num)', 'Desa::cek_dokumen_permohonan/$1');
$routes->post('desa/terima-berkas/(:num)', 'Desa::terima_berkas_permohonan/$1');
$routes->post('desa/tolak-berkas/(:num)', 'Desa::tolak_berkas_permohonan/$1');
$routes->get('data-warga', 'Desa::data_warga');
$routes->post('hapus-user/(:num)', 'Desa::delete/$1');
$routes->get('desa-laporan', 'Desa::laporan_permohonan');

$routes->get('kades', 'Kades::dashboard');
$routes->get('daftar-pengajuan-warga', 'Kades::data_permohonan');
$routes->get('kades-cek-dokumen/(:num)', 'Kades::cek_dokumen_permohonan/$1');
$routes->post('kades-preview-surat', 'Kades::create_permohonan_surat');
$routes->post('kades-terbitkan-surat', 'Kades::terbitkan_surat');

$routes->get('admin-kecamatan', 'Kecamatan::dashboard');
$routes->get('daftar-pengajuan-surat', 'Kecamatan::data_permohonan');
$routes->get('kecamatan_cek-dokumen/(:num)', 'Kecamatan::cek_dokumen_permohonan/$1');
$routes->post('kecamatan-tolak-berkas/(:num)', 'Kecamatan::tolak_berkas_permohonan/$1');
$routes->post('kecamatan-terima-preview', 'Kecamatan::create_permohonan_legalisasi');
$routes->post('kecamatan-terbitkan-surat', 'Kecamatan::terbitkan_legalisasi_surat');
$routes->get('kecamatan-data-desa', 'Kecamatan::data_desa');
$routes->get('kecamatan-data-admin', 'Kecamatan::data_admin_desa');
$routes->post('kecamatan-add-admin', 'Kecamatan::create_admin_desa');
$routes->get('kecamatan-jenis-surat', 'Kecamatan::data_jenis_surat');
$routes->post('kecamatan-add-jenis-surat', 'Kecamatan::create_jenis_surat');
$routes->post('kecamatan-delete-jenis/(:num)', 'Kecamatan::hapus_jenis_surat/$1');
$routes->get('kecamatan-laporan', 'Kecamatan::laporan');

$routes->get('data-berita', 'Berita::data_berita');
$routes->get('create-berita', 'Berita::tambah_berita');
$routes->post('post-berita', 'Berita::simpan_berita');
$routes->get('edit-berita/(:segment)', 'Berita::edit/$1');
$routes->post('update-berita/(:num)', 'Berita::update/$1');
$routes->post('delete-berita/(:num)', 'Berita::delete/$1');
