<?php

function tanggalIndo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    $tanggalArray = explode('-', $tanggal);
    $tahun = $tanggalArray[0];
    $bulanIndo = $bulan[(int)$tanggalArray[1]];
    $hari = $tanggalArray[2];
    return $hari . ' ' . $bulanIndo . ' ' . $tahun;
}

$namaAnak = $permohonan['nama_anak'];
$tempatLahir = $permohonan['tempat_lahir'];
$tanggalLahir = tanggalIndo($permohonan['tanggal_lahir']);
$namaAyah = $permohonan['nama_ayah'];
$namaIbu = $permohonan['nama_ibu'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Lais Kabupaten Musi Banyuasin";
$tanggalSurat = tanggalIndo(date('Y-m-d'));
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

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 90px;
            height: auto;
        }

        .header .title {
            flex-grow: 1;
            text-align: center;
        }

        .header-line {
            border-bottom: 3px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>
    <title>Surat Keterangan Kelahiran</title>
</head>

<body>
    <div class="header">
        <div class="title">
            <h2>PEMERINTAH KABUPATEN MUSI BANYUASIN</h2>
            <h2>KECAMATAN LAIS</h2>
            <p>Jalan Raya Palembang Sekayu KM. 80</p>
        </div>
    </div>

    <div class="header-line"></div>

    <div class="center">
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
        <p>Lais, <?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p class="bold">Muhammad Alief</p>
    </div>

</body>

</html>