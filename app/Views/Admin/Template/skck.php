<?php

$logoPath = base_url('AdminLTE/logo-muba.png');
$nama = $permohonan['nama_user'];
$tempatTanggalLahir = "Palembang, 01 Januari 1990"; // Ambil dari data user jika tersedia
$statusPerkawinan = "Belum Kawin"; // Ambil dari data user jika tersedia
$pekerjaan = "Mahasiswa"; // Ambil dari data user jika tersedia
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kabupaten Musi Banyuasin";
$tanggalSurat = date('d F Y');
$namaKades = "(Nama Kades)"; // Sesuaikan dengan nama Kepala Desa terkait

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .mt-1 {
            margin-top: 10px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td {
            padding: 5px;
            vertical-align: top;
        }
    </style>
    <title>Surat Pengantar SKCK</title>
</head>

<body>
    <div class="center">
        <img src="<?= base_url('AdminLTE/logo-muba.png') ?>" width="100">


        <h2>PEMERINTAH KABUPATEN MUSI BANYUASIN</h2>
        <h4>KECAMATAN LAIS</h4>
        <hr>
        <h3><u>SURAT KETERANGAN BERKELAKUAN BAIK</u></h3>
        <p>Nomor: ....../....../....../<?= date('Y') ?></p>
    </div>

    <p>Keuchik Desa <?= $permohonan['nama_desa'] ?> Kecamatan Kabupaten Musi Banyuasin, dengan ini menerangkan bahwa:</p>

    <table>
        <tr>
            <td>Nama</td>
            <td>: <?= $nama ?></td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>: <?= $tempatTanggalLahir ?></td>
        </tr>
        <tr>
            <td>Status Perkawinan</td>
            <td>: <?= $statusPerkawinan ?></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <?= $pekerjaan ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $alamat ?></td>
        </tr>
    </table>

    <p class="mt-2">Benar yang tersebut namanya di atas adalah penduduk yang berkelakuan baik, tidak pernah melakukan tindak pidana, dan tidak terlibat dalam penggunaan narkoba.</p>

    <p>Surat ini diberikan untuk dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p><?= $tanggalSurat ?></p>
        <p>Camat Lais desa'] ?></p>
        <br><br>
        <p class="bold">Muhammad Alief , S.kom</p>
    </div>

</body>

</html>