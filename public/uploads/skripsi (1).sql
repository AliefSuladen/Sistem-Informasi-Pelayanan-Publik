-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2025 pada 22.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `id_desa` int(11) NOT NULL,
  `nama_desa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `desa`
--

INSERT INTO `desa` (`id_desa`, `nama_desa`) VALUES
(1, 'Danau Cala'),
(2, 'Rantau Keroya'),
(3, 'Tanjung Agung Timur'),
(4, 'Petaling'),
(5, 'Lais'),
(6, 'Teluk'),
(7, 'Epil'),
(8, 'Purwosari'),
(9, 'Tanjung Agung Barat'),
(10, 'Tanjung Agung Selatan'),
(11, 'Tanjung Agung Utara'),
(12, 'Teluk Kijing I'),
(13, 'Teluk Kijing II'),
(14, 'Teluk Kijing III');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_pengajuan`
--

CREATE TABLE `dokumen_pengajuan` (
  `id_dokumen` int(11) NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `file_dokumen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen_pengajuan`
--

INSERT INTO `dokumen_pengajuan` (`id_dokumen`, `id_permohonan`, `nama_dokumen`, `file_dokumen`) VALUES
(1, 1, 'photo_2025-01-21_04-00-51.jpg', '1741726970_43d5d73e53e81694c92b.jpg'),
(2, 2, 'M. Alief Suladen.png', '1741732619_975c4be51405610fe9a4.png'),
(3, 3, 'contoh-SKTM.jpg', '1742769882_4cddfed79fe7db84992b.jpg'),
(4, 4, 'contoh-SKTM.jpg', '1742770108_adbb07f8103afd48c0a7.jpg'),
(5, 5, 'Blank board (6).png', '1746810227_a66e1e6ad78f79b950cb.png'),
(6, 5, 'Blank board (1).png', '1746810227_f7856938e3e886a0b4e1.png'),
(7, 6, 'Diagram Tanpa Judul.drawio.png', '1746810332_5bf7c2b7c3f01e963448.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`) VALUES
(2, 'Admin Desa'),
(1, 'Admin Kecamatan'),
(3, 'Masyarakat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis` int(11) NOT NULL,
  `surat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id_jenis`, `surat`) VALUES
(1, 'Surat Keterangan Tidak Mampu'),
(2, 'Surat Domisili'),
(3, 'Surat Kelahiran'),
(4, 'Surat Kematian'),
(5, 'Surat Pengantar SKCK'),
(6, 'Surat Izin Usaha'),
(7, 'Surat Keterangan Usaha');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-03-11-202841', 'App\\Database\\Migrations\\Pusingg', 'default', 'App', 1741725000, 1),
(2, '2025-03-11-203141', 'App\\Database\\Migrations\\Jilid2', 'default', 'App', 1741725408, 2),
(3, '2025-03-11-203809', 'App\\Database\\Migrations\\Jilid3', 'default', 'App', 1741725611, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_surat`
--

CREATE TABLE `permohonan_surat` (
  `id_permohonan` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_jenis` int(11) UNSIGNED NOT NULL,
  `id_status` int(11) UNSIGNED NOT NULL,
  `alasan_sktm` text DEFAULT NULL,
  `nama_anak` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nama_alm` varchar(100) DEFAULT NULL,
  `nik_alm` varchar(20) DEFAULT NULL,
  `tempat_kematian` varchar(100) DEFAULT NULL,
  `tanggal_kematian` date DEFAULT NULL,
  `sebab_kematian` varchar(255) DEFAULT NULL,
  `tujuan_skck` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(100) DEFAULT NULL,
  `jenis_usaha` varchar(100) DEFAULT NULL,
  `alamat_usaha` text DEFAULT NULL,
  `status_perkawinan` enum('Belum Menikah','Menikah','Cerai Hidup','Cerai Mati') DEFAULT NULL,
  `modal_usaha` varchar(50) DEFAULT NULL,
  `alasan_penolakan` varchar(255) DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permohonan_surat`
--

INSERT INTO `permohonan_surat` (`id_permohonan`, `id_user`, `id_jenis`, `id_status`, `alasan_sktm`, `nama_anak`, `tempat_lahir`, `tanggal_lahir`, `nama_ayah`, `nama_ibu`, `nama_alm`, `nik_alm`, `tempat_kematian`, `tanggal_kematian`, `sebab_kematian`, `tujuan_skck`, `nama_usaha`, `jenis_usaha`, `alamat_usaha`, `status_perkawinan`, `modal_usaha`, `alasan_penolakan`, `file_surat`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 3, NULL, 'Wiliam Alexander', 'Palembang', '2025-03-12', 'Alep', 'Aqila', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KELAHIRAN_wahyu Pradinata_1742765445.pdf', '2025-03-11 21:02:50', '2025-03-23 21:30:50'),
(2, 4, 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Roti Beranak', 'Dagang', NULL, NULL, NULL, NULL, NULL, '2025-03-11 22:36:59', '2025-05-09 20:22:03'),
(4, 6, 1, 2, 'syarat untuk menerima beasiswa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-23 22:48:28', '2025-05-09 18:33:34'),
(5, 4, 1, 4, 'saya miskin pak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kamau Sudah Banyak Uang', NULL, '2025-05-09 17:03:47', '2025-05-09 18:02:08'),
(6, 4, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_PENGANTAR_SKCK_Ricky_1746812002.pdf', '2025-05-09 17:05:32', '2025-05-09 17:33:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_surat`
--

CREATE TABLE `status_surat` (
  `id_status` int(11) UNSIGNED NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_surat`
--

INSERT INTO `status_surat` (`id_status`, `status`) VALUES
(4, 'Ditolak'),
(2, 'Diverifikasi Pihak Desa'),
(1, 'Pending'),
(3, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama_user`, `email`, `password`, `role`, `id_desa`, `pekerjaan`, `agama`, `kelamin`, `alamat`, `foto`) VALUES
(1, '20202020', 'Aqila Faradifa Khansa', 'aqila@gmail.com', '1234', 1, 0, 'Aparatur Sipil Negara', 'Islam', 'Perempuan', 'dusun 5 talang ucin', '1746815710_86ed6d1cc843be19041f.jpg'),
(2, '10101010', 'Muhammad Alief', 'alief12@gmail.com', '1234', 2, 1, 'Aparatur Sipil Negara', 'Islam', 'Laki-laki', 'dusun 1', '1746810371_e6402a9a6c12aa0e8a87.jpg'),
(3, '1606020908020001', 'wahyu Pradinata', 'mardalius18@gmail.com', '1234', 3, 1, 'Buruh', 'Kristen', 'Laki-laki', 'jalan mangsa kades rt.45 dusun 5', NULL),
(4, '1111111111111111', 'Ricky', 'riki@gmail.com', '1234', 3, 1, 'Mahasiswa', 'Islam', 'Laki-laki', 'jl, in aja dulu', '1746809343_91165682c43d7ba59ed0.png'),
(6, '0000000000000000', 'Salsabila Betamahesa', 'salsa@hotmail.com', '1234', 3, 1, 'Pelajar', 'Islam', 'Perempuan', 'jalan menuju surga', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id_desa`);

--
-- Indeks untuk tabel `dokumen_pengajuan`
--
ALTER TABLE `dokumen_pengajuan`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan` (`jabatan`);

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permohonan_surat`
--
ALTER TABLE `permohonan_surat`
  ADD PRIMARY KEY (`id_permohonan`);

--
-- Indeks untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `desa`
--
ALTER TABLE `desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `dokumen_pengajuan`
--
ALTER TABLE `dokumen_pengajuan`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permohonan_surat`
--
ALTER TABLE `permohonan_surat`
  MODIFY `id_permohonan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  MODIFY `id_status` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
