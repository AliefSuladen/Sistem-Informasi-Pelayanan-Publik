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

// Data dari controller
$nama = $permohonan['nama_user'];
$nik = $permohonan['nik'];
$jenisKelamin = $permohonan['kelamin'];
$agama = $permohonan['agama'];
$pekerjaan = $permohonan['pekerjaan'];
$alasan = $permohonan['alasan_sktm'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Lais, Kabupaten Musi Banyuasin";
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratSKTM();

// Konversi logo ke base64
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
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .logo {
            width: 100px;
            margin-right: 20px;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        .header-line {
            border-bottom: 3px solid black;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        td {
            padding: 4px;
            vertical-align: top;
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

    <div style="text-align:center;">
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

    <p style="margin-top:20px;">
        Berdasarkan pengamatan dan data yang ada, yang bersangkutan tergolong keluarga yang tidak mampu secara ekonomi.
        Surat ini diterbitkan untuk keperluan: <b><?= $alasan ?></b>.
    </p>

    <p>Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.</p>

    <div style="text-align:right; margin-top:50px;">
        <p>Lais, <?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p><b>Muhammad Alief</b></p>
    </div>

</body>

</html>