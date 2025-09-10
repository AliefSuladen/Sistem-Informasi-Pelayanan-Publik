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
$tgl_kematian = $permohonan['tanggal_kematian'];
$sebab = $permohonan['sebab_kematian'];
$tempat = $permohonan['tempat_kematian'];
$tgl_lahir = $permohonan['tgl_lahir'];
$nama = $permohonan['nama_alm'];
$nik = $permohonan['nik_alm'];
$jenisKelamin = $permohonan['kelamin_alm'];
$ttl = $permohonan['ttl_alm'];
$agama = $permohonan['agama_alm'];
$pekerjaan = $permohonan['pekerjaan_alm'];
$alamat = $permohonan['alamat_alm'];
$tanggalSurat = tanggalIndo(date('Y-m-d'));


$logoSrc = '';
$logoFile = FCPATH . 'uploads/logo.jpg';
if (file_exists($logoFile)) {
    $logoData = file_get_contents($logoFile);
    $logoBase64 = base64_encode($logoData);
    $logoSrc = 'data:image/jpeg;base64,' . $logoBase64;
}

$ttdSrc = '';
$ttdFile = FCPATH . 'uploads/TTD.png';
if (file_exists($ttdFile)) {
    $ttdData = file_get_contents($ttdFile);
    $ttdBase64 = base64_encode($ttdData);
    $ttdSrc = 'data:image/png;base64,' . $ttdBase64;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Kematian</title>
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
            margin-right: 65px;
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
        <h3 class="underline">SURAT KETERANGAN KEMATIAN</h3>
        <p>Nomor: <?= $permohonan['nomor_surat'] ?></p>
    </div>

    <!-- Isi Surat -->
    <p class="isi">Kepala Desa Teluk kijing III Kecamatan Lais Kabupeten Musi Banyuasin Provinsi Sumatera Selatan, menerangkan bahwa :</p>

    <table style="margin-left: 60px; border-collapse: collapse; line-height: 1.2;">
        <tr>
            <td style="width:150px;">Nama</td>
            <td>: <?= $nama ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: <?= $nik ?></td>
        </tr>
        <tr>
            <td>Tempat Tgl. Lahir</td>
            <td>: <?= $ttl ?></td>
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
            <td>: <?= $pekerjaan ?></td>
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
    <p class="isi">Orang yang namanya diatas memang benar telah meninggal dunia pada :</p>
    <table style="margin-left: 60px; border-collapse: collapse; line-height: 1.2;">
        <tr>
            <td style="width:150px;">Tanggal</td>
            <td>: <?= $tgl_kematian ?></td>
        </tr>
        <tr>
            <td style="width:150px;">Bertempat di</td>
            <td>: <?= $tempat ?></td>
        </tr>
        <tr>
            <td style="width:150px;">Disebabkan</td>
            <td>: <?= $sebab ?></td>
        </tr>
    </table>

    <?php if (isset($isPreviewCamat) && $isPreviewCamat): ?>
        <div class="signature">
            <p>Teluk Kijing III, <?= $tanggalSurat ?></p>
            <p>KEPALA DESA TELUK KIJING III</p>
            <br>
            <?php if ($ttdSrc): ?>
                <img src="<?= $ttdSrc ?>" style="width:150px; height:auto;">
            <?php endif; ?>
            <p class="bold underline">YUPANSER AHMAD, SE</p>
        </div>

        <div class="signature" style="text-align:center; margin-top:40px;">
            <p>Lais, <?= $tanggalSurat ?></p>
            <p>Nomor : <?= $nomorSuratCamat ?></p>
            <?php if ($ttdSrc): ?>
                <img src="<?= $ttdSrc ?>" style="width:150px; height:auto;">
            <?php endif; ?>
            <p class="bold underline">Risdianto, S.pd., M.M</p>
            <p>NIP. 197705162007011007</p>
        </div>
        <?php if (!empty($qrCode)): ?>
            <div style="margin-top:250px; margin-left: 10px;">
                <img src="<?= $qrCode ?>" width="50">
                <p>*scan untuk melihat keaslian surat</p>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="signature">
            <p>Teluk Kijing III, <?= $tanggalSurat ?></p>
            <p>KEPALA DESA TELUK KIJING III</p>
            <?php if ($ttdSrc): ?>
                <img src="<?= $ttdSrc ?>" style="width:150px; height:auto;">
            <?php endif; ?>
            <p class="bold underline">YUPANSER AHMAD, SE</p>
        </div>
        <?php if (!empty($qrCode)): ?>
            <div style="margin-top:50px; margin-left: 50px;">
                <p><small>Scan QR untuk verifikasi surat ini:</small></p>
                <img src="<?= $qrCode ?>" width="100">
            </div>
        <?php endif; ?>
    <?php endif; ?>

</body>

</html>