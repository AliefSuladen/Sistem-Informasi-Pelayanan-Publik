-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Sep 2025 pada 15.42
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
(7, 6, 'Diagram Tanpa Judul.drawio.png', '1746810332_5bf7c2b7c3f01e963448.png'),
(8, 7, 'Screenshot 2025-01-19 022428.png', '1746898183_1b28e2bc54a26e03f3fa.png'),
(9, 8, 'Screenshot 2025-01-21 185948.png', '1746898710_fefa168568da6866e1cb.png'),
(10, 9, 'Screenshot 2025-02-05 031247.png', '1746898839_f7999b1a9e1f15b79305.png'),
(11, 10, 'Screenshot 2025-01-21 185948.png', '1746902190_f26a786d42b0a5d0000b.png'),
(12, 11, 'Screenshot 2025-01-18 214850.png', '1746903294_3ff64c75efb0c8d2ef4b.png'),
(13, 12, 'Screenshot 2025-01-21 185948.png', '1746903365_f6fff346c130db693b07.png'),
(14, 13, 'Screenshot 2025-01-21 185948.png', '1746903720_d15f3cbc5112661b8abe.png'),
(15, 14, 'Screenshot 2025-01-21 185948.png', '1746904702_55b02762b20dc5b1a539.png'),
(16, 15, 'Screenshot 2025-01-21 185948.png', '1746905231_98e8b7883389e3e8642c.png'),
(17, 16, 'Screenshot 2025-01-21 185948.png', '1746905847_157b433a9a0ea002f5c1.png'),
(18, 17, 'Screenshot 2025-01-21 185948.png', '1746906243_9992667c1abdfd063f6f.png'),
(19, 18, 'Screenshot 2025-01-21 185948.png', '1746906362_117cf83d0bdf50949c04.png'),
(20, 19, 'Screenshot 2025-01-18 214850.png', '1746992965_dfbfb769425e215e6532.png'),
(21, 20, 'Screenshot 2025-01-18 214850.png', '1746993000_fbfd05da55d13de5fd5f.png'),
(22, 21, 'Screenshot 2025-01-21 185948.png', '1746993040_3e92a87d2ff38737e0e6.png'),
(23, 22, 'WhatsApp Image 2025-08-06 at 13.04.49_675417ec.jpg', '1754751405_09b6684868e6a7181ba0.jpg'),
(24, 23, 'M. Alief Suladen.png', '1754824482_a59f55befea584622a40.png'),
(25, 24, 'rifqi1.jpg', '1754824676_8af9bd35e8d179e80d8b.jpg'),
(26, 25, 'foto_camat.jpg', '1754826464_e5ba73b50a2b53885500.jpg'),
(27, 26, 'M. Alief Suladen.png', '1757486586_ca17b41c36024a02f791.png'),
(28, 27, 'rifqi3.jpg', '1757487919_35708b17a7c6e1ee460c.jpg'),
(29, 28, 'M. Alief Suladen.png', '1757488614_1ab2b5429c4f0ea1d9cb.png'),
(30, 29, 'photo_2025-01-21_04-00-51.jpg', '1757492792_1cae3a9a5da6a8c3c6d8.jpg'),
(31, 30, 'rifqi3.jpg', '1757493823_65b08284df1bc69249f4.jpg'),
(32, 31, 'rifqi4.jpg', '1757497669_28284c829381d533419f.jpg'),
(33, 32, 'rifqi4.jpg', '1757498564_dae3aeb84f4ddf4a6f32.jpg'),
(34, 33, 'rifqi4.jpg', '1757500098_cba2309f2fda0fd07adc.jpg'),
(35, 33, 'M. Alief Suladen.png', '1757504898_e633bd346573cdeab04f.png'),
(36, 30, 'photo_2025-01-21_04-00-51.jpg', '1757507899_00ba4f24692e7e3ce32b.jpg'),
(37, 30, 'photo_2025-01-21_19-20-18.jpg', '1757507899_79426d75e3215d25ff6b.jpg'),
(38, 29, 'photo_2025-01-21_19-20-18.jpg', '1757508268_50d31194b77facae1d23.jpg'),
(39, 29, 'photo_2025-01-21_04-00-51.jpg', '1757508268_b20f2152a921b73c7134.jpg'),
(40, 34, 'M. Alief Suladen.png', '1757516574_5c9171cb2fac8e536dd5.png'),
(41, 35, 'M. Alief Suladen.png', '1757519241_1f00efda07222cc97acb.png'),
(42, 36, 'foto_camat.jpg', '1757681656_f76922fe55eb8a470517.jpg'),
(43, 36, 'logo.jpg', '1757681900_88f357a7955c7316566b.jpg');

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
(5, 'Camat'),
(4, 'Kepala Desa'),
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
(6, 'Surat Keterangan Kehilangan'),
(7, 'Surat Keterangan Usaha'),
(8, 'Surat Pengantar Pindah');

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
  `nomor_surat` varchar(25) DEFAULT NULL,
  `id_status` int(11) UNSIGNED NOT NULL,
  `alasan_sktm` text DEFAULT NULL,
  `nama_anak` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nama_alm` varchar(100) DEFAULT NULL,
  `nik_alm` varchar(20) DEFAULT NULL,
  `ttl_alm` varchar(25) DEFAULT NULL,
  `kelamin_alm` enum('Laki-Laki','Perempuan','','') DEFAULT NULL,
  `agama_alm` varchar(25) DEFAULT NULL,
  `pekerjaan_alm` varchar(25) DEFAULT NULL,
  `alamat_alm` text DEFAULT NULL,
  `tempat_kematian` varchar(100) DEFAULT NULL,
  `tanggal_kematian` date DEFAULT NULL,
  `sebab_kematian` varchar(255) DEFAULT NULL,
  `tujuan_skck` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(100) DEFAULT NULL,
  `alamat_usaha` text DEFAULT NULL,
  `brg_hilang` varchar(50) DEFAULT NULL,
  `tgl_hilang` date DEFAULT NULL,
  `tempat_kehilangan` text DEFAULT NULL,
  `nomor_kk` varchar(16) DEFAULT NULL,
  `nama_kk` varchar(25) DEFAULT NULL,
  `alamat_tujuan` text DEFAULT NULL,
  `desa_tujuan` varchar(25) DEFAULT NULL,
  `kec_tujuan` varchar(25) DEFAULT NULL,
  `kab_tujuan` varchar(25) DEFAULT NULL,
  `jumlah_pindah` varchar(10) DEFAULT NULL,
  `alasan_penolakan` varchar(255) DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permohonan_surat`
--

INSERT INTO `permohonan_surat` (`id_permohonan`, `id_user`, `id_jenis`, `nomor_surat`, `id_status`, `alasan_sktm`, `nama_anak`, `tempat_lahir`, `tanggal_lahir`, `nama_ayah`, `nama_ibu`, `nama_alm`, `nik_alm`, `ttl_alm`, `kelamin_alm`, `agama_alm`, `pekerjaan_alm`, `alamat_alm`, `tempat_kematian`, `tanggal_kematian`, `sebab_kematian`, `tujuan_skck`, `nama_usaha`, `alamat_usaha`, `brg_hilang`, `tgl_hilang`, `tempat_kehilangan`, `nomor_kk`, `nama_kk`, `alamat_tujuan`, `desa_tujuan`, `kec_tujuan`, `kab_tujuan`, `jumlah_pindah`, `alasan_penolakan`, `file_surat`, `created_at`, `updated_at`) VALUES
(23, 4, 1, NULL, 2, 'Beasiswa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KETERANGAN_TIDAK_MAMPU_Ricky_1754824526.pdf', '2025-08-10 11:14:42', '2025-09-10 10:14:27'),
(24, 4, 1, NULL, 4, 'erwere', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KETERANGAN_TIDAK_MAMPU_Ricky_1754825640.pdf', '2025-08-10 11:17:56', '2025-09-12 14:58:28'),
(25, 4, 3, NULL, 4, NULL, 'Mentari Tumbuh Rinjani Putri', 'Talang Ucin', '2025-09-08', 'Ricky Rinaldo', 'Salsabila', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KELAHIRAN_Ricky_1754826499.pdf', '0000-00-00 00:00:00', '2025-09-12 14:58:33'),
(26, 4, 8, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1616161616161616', 'Sulaiman', 'Gandus Grand Raya Blok A.7', 'Gandus', 'Gandus', 'Palembang', '2', NULL, 'SURAT_PENGANTAR_PINDAH_Ricky Rinaldo _1757486802.pdf', '2025-09-10 06:43:06', '2025-09-12 14:58:24'),
(27, 4, 4, '470/001/TK.III/IX/2025', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'Ahmad Sharoni', '1111111222222222', 'Palembang, 09 Agustus 197', '', 'Islam', 'DPR', 'Bukit Lama', 'RSMH', '2025-08-23', 'Kekenyangan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KEMATIAN_Ricky Rinaldo _CAMAT_1757689044.pdf', '2025-09-10 07:05:19', '2025-09-12 14:57:50'),
(28, 4, 2, '470/002/TK.III/IX/2025', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dokumen Pendukung Tidak lengkap, PBB', 'SURAT_DOMISILI_Ricky Rinaldo _1757488739.pdf', '2025-09-10 07:16:54', '2025-09-10 13:14:03'),
(29, 4, 2, '470/004/TK.III/IX/2025', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_DOMISILI_Ricky Rinaldo _CAMAT_1757516303.pdf', '2025-09-10 08:26:32', '2025-09-10 14:58:28'),
(30, 4, 5, '470/003/TK.III/IX/2025', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Melamar Pekerjaan Di Indomaret', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_PENGANTAR_SKCK_Ricky Rinaldo _CAMAT_1757515708.pdf', '2025-09-10 08:43:43', '2025-09-10 14:48:33'),
(31, 4, 6, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Surat Izin Mengemudi', '2025-09-10', 'Perjalanan Dari Kampus Ke Rumah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KTP anda tidak terdaftar', NULL, '2025-09-10 09:47:49', '2025-09-10 10:01:57'),
(32, 4, 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SIM', '2025-09-10', 'Perjalanan Pulang Dari Kantor Ke Rumah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-10 10:02:44', '2025-09-10 10:02:44'),
(33, 4, 4, '470/005/TK.III/IX/2025', 5, NULL, NULL, NULL, NULL, NULL, NULL, 'Kunto', '9876567898765434', 'Betung, 09 Agustus 2000', 'Laki-Laki', 'Islam', 'Petani', 'Dusun 2 Talang Duku', 'Rumah', '2025-09-10', 'Kecelakaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KEMATIAN_Ricky Rinaldo _CAMAT_1757515777.pdf', '2025-09-10 10:28:18', '2025-09-10 14:49:42'),
(34, 4, 5, '470/006/TK.III/IX/2025', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Begawe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_PENGANTAR_SKCK_Ricky Rinaldo _CAMAT_1757521295.pdf', '2025-09-10 15:02:54', '2025-09-10 16:22:09'),
(35, 4, 4, '470/007/TK.III/IX/2025', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Andika', '1212121212121212', 'Palembang, 03 Mei 1997', 'Laki-Laki', 'Islam', 'Mahasiswa', 'Bukit Lama', 'Rumah', '2025-09-10', 'Sakit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_KEMATIAN_Ricky Rinaldo _1757687931.pdf', '2025-09-10 15:47:21', '2025-09-12 14:58:20'),
(36, 4, 2, '470/008/TK.III/IX/2025', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SURAT_DOMISILI_Ricky Rinaldo _CAMAT_1757681953.pdf', '2025-09-12 12:54:16', '2025-09-12 12:59:21');

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
(6, 'Ditolak'),
(2, 'Diverifikasi Admin Desa'),
(4, 'Menunggu Verifikasi'),
(1, 'Pending'),
(3, 'Selesai - Surat Diterbitkan Oleh Desa'),
(5, 'Selesai - Surat Diterbitkan Oleh Kecamatan');

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
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama_user`, `email`, `password`, `role`, `id_desa`, `pekerjaan`, `agama`, `kelamin`, `alamat`, `tempat_lahir`, `tgl_lahir`, `foto`) VALUES
(1, '20202020', 'Yupanser Ahmad, SE', 'aqila@gmail.com', '1234', 4, 14, 'Aparatur Sipil Negara', 'Islam', 'Perempuan', 'dusun 5 talang ucin', NULL, NULL, '1746815710_86ed6d1cc843be19041f.jpg'),
(2, '10101010', 'Muhammad Alief', 'alief12@gmail.com', '1234', 2, 14, 'Aparatur Sipil Negara', 'Islam', 'Laki-laki', 'dusun 1', NULL, NULL, '1746810371_e6402a9a6c12aa0e8a87.jpg'),
(4, '1111111111111111', 'Ricky Rinaldo ', 'riki@gmail.com', '1234', 3, 14, 'Mahasiswa', 'Islam', 'Laki-laki', 'Dusun 5 Talang Ucin, Desa Teluk Kijing III.', 'Palembang', '2005-09-01', '1746809343_91165682c43d7ba59ed0.png'),
(8, '1606020908020002', 'Muhammad Indra', 'indra@gmail.com', '1234', 1, 0, 'Aparatur Sipil Negara', 'Islam', 'Laki-laki', 'jl.palembang betung km.73 desa lais', 'Palembang', '2018-09-05', '1757503152_7d96a671694647f10d13.jpg');

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
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permohonan_surat`
--
ALTER TABLE `permohonan_surat`
  MODIFY `id_permohonan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  MODIFY `id_status` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
