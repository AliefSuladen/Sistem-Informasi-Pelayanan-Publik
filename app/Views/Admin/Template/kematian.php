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

    // Pastikan input dalam format 'YYYY-MM-DD'
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal)) {
        $tanggalArray = explode('-', $tanggal);
        $tahun = $tanggalArray[0];
        $bulanIndo = $bulan[(int)$tanggalArray[1]] ?? '';
        $hari = $tanggalArray[2];
        return $hari . ' ' . $bulanIndo . ' ' . $tahun;
    }

    // Jika tidak valid, kembalikan seperti apa adanya
    return $tanggal;
}
$namaAlmarhum = $permohonan['nama_alm'];
$nik = $permohonan['nik_alm'];
$tempat = $permohonan['tempat_kematian'];
$tanggalMeninggal = tanggalIndo($permohonan['tanggal_kematian']);
$penyebab = $permohonan['sebab_kematian'];
$alamat = "Desa " . $permohonan['nama_desa'] . ", Kecamatan Lais, Kabupaten Musi Banyuasin";
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratKematian();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Kematian</title>
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
        <h3><u>SURAT KETERANGAN KEMATIAN</u></h3>
        <p>Nomor: <?= $nomorSurat ?></p>
    </div>

    <p>Yang bertanda tangan di bawah ini, Camat Lais, Kabupaten Musi Banyuasin, menerangkan bahwa:</p>

    <table>
        <tr>
            <td>Nama</td>
            <td>: <b><?= $namaAlmarhum ?></b></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <?= $nik ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $alamat ?></td>
        </tr>
    </table>

    <p class="mt-2">Telah meninggal dunia di <b><?= $tempat ?></b> pada tanggal <b><?= $tanggalMeninggal ?></b> karena <b><?= $penyebab ?></b>.</p>

    <p>Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Lais, <?= $tanggalSurat ?></p>
        <p>Camat Lais</p>
        <br><br>
        <p class="bold">Muhammad Alief</p>
    </div>
</body>

</html>