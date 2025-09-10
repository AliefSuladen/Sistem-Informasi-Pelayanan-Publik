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

$tempat_lahir = $permohonan['tempat_lahir'];
$tgl_lahir = $permohonan['tgl_lahir'];
$nama = $permohonan['nama_user'];
$nik = $permohonan['nik'];
$jenisKelamin = $permohonan['kelamin'];
$agama = $permohonan['agama'];
$namaUsaha = $permohonan['nama_usaha'];
$alamatUsaha = $permohonan['alamat_usaha'];
$tanggalSurat = tanggalIndo(date('Y-m-d'));

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
    <title>Surat Keterangan Usaha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid black;
            padding-bottom: 5px;
        }

        .isi {
            margin-top: 20px;
            margin-left: 40px;
            margin-right: 40px;
        }

        table {
            width: 100%;
            margin-left: 40px;
        }

        td {
            vertical-align: top;
            padding: 3px;
        }

        .signature {
            margin-top: 40px;
            margin-right: 50px;
            text-align: center;
            float: right;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT -->
    <div style="display: table; width: 100%; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 20px;">
        <div style="display: table-cell; width: 100px; vertical-align: middle;">
            <img src="<?= $logoSrc ?>" style="width: 80px; height: auto; margin-left: 20px;">
        </div>
        <div style="display: table-cell; text-align: center; vertical-align: middle;">
            <h4 style="margin:0;">PEMERINTAH KABUPATEN MUSI BANYUASIN</h4>
            <h4 style="margin:0;">KECAMATAN LAIS</h4>
            <h3 style="margin:0;">DESA TELUK KIJING III</h3>
            <p style="margin:0;">Alamat : Jl. Betung - Sekayu Km 76 Talang Duku Kode Pos 30757</p>
        </div>
    </div>

    <!-- Judul Surat -->
    <div class="center">
        <h3 class="underline">SURAT KETERANGAN USAHA</h3>
        <p>Nomor: <?= $permohonan['nomor_surat'] ?></p>
    </div>

    <!-- Isi Surat -->
    <p class="isi">Kepala Desa Teluk kijing III Kecamatan Lais Kabupeten Musi Banyuasin Provinsi Sumatera Selatan, menerangkan bahwa :</p>

    <table style="margin-left: 60px; border-collapse: collapse; line-height: 1.2;">
        <tr>
            <td style="width:150px;">Nama</td>
            <td>:<?= $nama ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <?= $nik ?></td>
        </tr>
        <tr>
            <td>Tempat Tgl. Lahir</td>
            <td>: <?= $tempat_lahir ?>, <?= tanggalIndo($tgl_lahir) ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $jenisKelamin ?></td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td>: Indonesia</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <?= $permohonan['pekerjaan'] ?></td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: <?= $agama ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $permohonan['alamat'] ?></td>
        </tr>
    </table>

    <p class="isi">Menurut sepengetahuan kami orang yang namanya diatas tersebut memang benar memiliki <b><?= $namaUsaha ?></b> yang terletak di <?= $alamatUsaha ?> Desa Teluk Kijing III Kecamatan Lais Kabupaten Musi Banyuasin.</p>

    <p class="isi">Demikian Surat Keterangan ini dibuat berdasarkan keterangan yang bersangkutan serta dapat dipergunakan sebagaimana perlunya.</p>

    <!-- Tanda Tangan -->
    <div class="signature">
        <p>Teluk Kijing III, <?= $tanggalSurat ?></p>
        <p>KEPALA DESA TELUK KIJING III</p>
        <br><br>
        <p class="bold underline">YUPANSER AHMAD, SE</p>
    </div>

    <!-- QR Code (opsional) -->
    <?php if (!empty($qrCode)): ?>
        <div style="margin-top:50px; margin-left: 50px;">
            <p><small>Scan QR untuk verifikasi surat ini:</small></p>
            <img src="<?= $qrCode ?>" width="100">
        </div>
    <?php endif; ?>

</body>

</html>