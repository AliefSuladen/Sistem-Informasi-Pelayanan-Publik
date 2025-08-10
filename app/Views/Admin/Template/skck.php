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

    if (count($tanggalArray) === 3) {
        return $tanggalArray[2] . ' ' . $bulan[(int)$tanggalArray[1]] . ' ' . $tanggalArray[0];
    } else {
        return 'Tanggal tidak valid';
    }
}


$nama = $permohonan['nama_user'];
$nik = $permohonan['nik'];
$jenisKelamin = $permohonan['kelamin'];
$agama = $permohonan['agama'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Lais, Kabupaten Musi Banyuasin";
$tujuan = $permohonan['tujuan_skck'];
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratPengantarSKCK();

$logoSrc = '';
$logoFile = FCPATH . 'uploads/logo.jpg';
if (file_exists($logoFile)) {
    $logoData = file_get_contents($logoFile);
    $logoBase64 = base64_encode($logoData);
    $logoSrc = 'data:image/jpeg;base64,' . $logoBase64;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar SKCK</title>
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
    <div style="display: table; width: 100%; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 20px;">
        <div style="display: table-cell; width: 100px; vertical-align: middle;">
            <img src="<?= $logoSrc ?>" style="width: 90px; height: auto;">
        </div>
        <div style="display: table-cell; text-align: center; vertical-align: middle;">
            <h2 style="margin:0;">PEMERINTAH KABUPATEN MUSI BANYUASIN</h2>
            <h2 style="margin:0;">KECAMATAN LAIS</h2>
            <p style="margin:0;">Jalan Raya Palembang Sekayu KM. 80</p>
        </div>
    </div>

    <div class="center">
        <h3><u>SURAT PENGANTAR SKCK</u></h3>
        <p>Nomor: <?= $nomorSurat ?></p>
    </div>

    <p>Yang bertanda tangan di bawah ini, Camat Lais, Kabupaten Musi Banyuasin, dengan ini menerangkan bahwa:</p>

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
            <td>Alamat</td>
            <td>: <?= $alamat ?></td>
        </tr>
    </table>

    <p class="mt-2">Adalah benar yang bersangkutan merupakan warga kami dan berkelakuan baik. Surat ini dibuat sebagai pengantar untuk pembuatan SKCK dengan tujuan: <b><?= $tujuan ?></b>.</p>

    <p>Demikian surat pengantar ini dibuat dengan sebenarnya agar dapat digunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Lais, <?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p class="bold">Muhammad Alief</p>
    </div>

</body>

</html>