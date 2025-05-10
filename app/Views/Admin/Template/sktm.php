<?php
function tanggalIndo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $tanggalArray = explode('-', $tanggal);
    return count($tanggalArray) === 3
        ? $tanggalArray[2] . ' ' . $bulan[(int)$tanggalArray[1]] . ' ' . $tanggalArray[0]
        : 'Tanggal tidak valid';
}

// Data
$nama = $permohonan['nama_user'];
$nik = $permohonan['nik'];
$jenisKelamin = $permohonan['kelamin'];
$agama = $permohonan['agama'];
$pekerjaan = $permohonan['pekerjaan'];
$alasan = $permohonan['alasan_sktm'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Lais, Kabupaten Musi Banyuasin";
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratSKTM();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu</title>
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

        .qr {
            margin-top: 30px;
            text-align: left;
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
            text-align: center;
            margin-bottom: 10px;
        }

        .header-line {
            border-bottom: 3px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        img.qr-image {
            width: 100px;
            height: 100px;
        }

        .qr p {
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>PEMERINTAH KABUPATEN MUSI BANYUASIN</h2>
        <h2>KECAMATAN LAIS</h2>
        <p>Jalan Raya Palembang Sekayu KM. 80</p>
    </div>

    <div class="header-line"></div>

    <div class="center">
        <h3><u>SURAT KETERANGAN TIDAK MAMPU</u></h3>
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

    <p class="mt-2">
        Berdasarkan pengamatan dan data yang ada, yang bersangkutan tergolong keluarga yang tidak mampu secara ekonomi.
        Surat ini diterbitkan untuk keperluan: <b><?= $alasan ?></b>.
    </p>

    <p>Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Lais, <?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p class="bold">Muhammad Alief</p>
    </div>
</body>

</html>