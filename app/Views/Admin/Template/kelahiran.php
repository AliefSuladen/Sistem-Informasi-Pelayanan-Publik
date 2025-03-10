<?php

$namaAnak = $permohonan['nama_anak'];
$tempatLahir = $permohonan['tempat_lahir'];
$tanggalLahir = date('d F Y', strtotime($permohonan['tanggal_lahir']));
$namaAyah = $permohonan['nama_ayah'];
$namaIbu = $permohonan['nama_ibu'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Kabupaten Musi Banyuasin";
$tanggalSurat = date('d F Y');
$nomorSurat = model('Modelpermohonan')->getNomorSuratSKL();

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

        .header-line {
            border-bottom: 3px solid black;
            margin-bottom: 20px;
        }
    </style>
    <title>Surat Keterangan Kelahiran</title>
</head>

<body>
    <div class="center">
        <img src="<?= base_url('AdminLTE/logo-muba.png') ?>" width="100">


        <h2>PEMERINTAH KABUPATEN MUSI BANYUASIN</h2>
        <h2>KECAMATAN LAIS</h2>
        <div class="header-line"></div>
        <h3><u>SURAT KETERANGAN KELAHIRAN</u></h3>
        <p>Nomor: <?= $nomorSurat ?></p>
    </div>

    <p>Yang bertanda tangan di bawah ini, Camat Lais, Kabupaten Musi Banyuasin, menerangkan bahwa:</p>

    <table>
        <tr>
            <td>Nama Anak</td>
            <td>: <b><?= $namaAnak ?></b></td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: <?= $tempatLahir ?>, <?= $tanggalLahir ?></td>
        </tr>
        <tr>
            <td>Nama Ayah</td>
            <td>: <?= $namaAyah ?></td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>: <?= $namaIbu ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $alamat ?></td>
        </tr>
    </table>

    <p class="mt-2">Berdasarkan laporan yang telah diterima, anak tersebut lahir dengan keadaan sehat. Surat ini diberikan untuk keperluan administrasi kependudukan.</p>

    <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p><?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p class="bold">Muhammad Alief , S.kom</p>
    </div>

</body>

</html>