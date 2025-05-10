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
    return $tanggalArray[2] . ' ' . $bulan[(int)$tanggalArray[1]] . ' ' . $tanggalArray[0];
}

$nama = $permohonan['nama_user'];
$nik = $permohonan['nik'];
$tempatLahir = $permohonan['tempat_lahir'];
$jenisKelamin = $permohonan['kelamin'];
$agama = $permohonan['agama'];
$pekerjaan = $permohonan['pekerjaan'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Lais Kabupaten Musi Banyuasin";
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratDomisili();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili</title>
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
        <h3><u>SURAT KETERANGAN DOMISILI</u></h3>
        <p>Nomor: <?= $nomorSurat ?></p>
    </div>

    <p>Yang bertanda tangan di bawah ini, Camat Lais, Kabupaten Musi Banyuasin, menerangkan bahwa:</p>

    <table>
        <tr>
            <td>Nama</td>
            <td>: <b><?= $nama ?></b></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <?= $nik ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $jenisKelamin ?></td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: <?= $agama ?></td>
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

    <p class="mt-2">Berdasarkan data yang ada, benar bahwa nama tersebut adalah penduduk yang berdomisili di wilayah Kecamatan Lais, Kabupaten Musi Banyuasin.</p>

    <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Lais, <?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p class="bold">Muhammad Alief</p>
    </div>

</body>

</html>