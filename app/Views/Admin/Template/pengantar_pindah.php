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
$nomor_kk = $permohonan['nomor_kk'];
$nama_kk = $permohonan['nama_kk'];
$alamat_tujuan = $permohonan['alamat_tujuan'];
$desa_tujuan = $permohonan['desa_tujuan'];
$kec_tujuan = $permohonan['kec_tujuan'];
$kab_tujuan = $permohonan['kab_tujuan'];
$jumlah_pindah = $permohonan['jumlah_pindah'];
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratPindah();

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
    <title>Surat Pengantar Pindah</title>
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
            margin-left: 60px;
            border-collapse: collapse;
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
        <h3 class="underline">SURAT PENGANTAR PINDAH</h3>
        <h3 class="underline">ANTAR KABUPATEN / KOTA DALAM SATU PROVINSI</h3>
        <h4>Nomor: <?= $nomorSurat ?></h4>
    </div>

    <!-- Isi Surat -->
    <p class="isi">Yang bertanda tangan di bawah ini, Kepala Desa Teluk Kijing III, Kecamatan Lais, Kabupaten Musi Banyuasin, menerangkan bahwa:</p>

    <table style="width: 90%; margin: 0 auto; border-collapse: collapse; line-height: 1.3; font-size: 11pt;">
        <tr>
            <td style="width:180px; padding:4px 6px; vertical-align: top;">N I K</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $nik ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Nama Lengkap</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $nama ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Nomor Kartu Keluarga</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $nomor_kk ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Nama Kepala Keluarga</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $nama_kk ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Alamat Sekarang</td>
            <td style="padding:4px 6px; vertical-align: top; word-wrap: break-word; max-width:400px;">
                : <?= $permohonan['alamat'] ?>
            </td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Alamat Tujuan Pindah</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $alamat_tujuan ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Desa/Kelurahan</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $desa_tujuan ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Kecamatan</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $kec_tujuan ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Kabupaten</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $kab_tujuan ?></td>
        </tr>
        <tr>
            <td style="padding:4px 6px; vertical-align: top;">Jumlah Keluarga Yang Pindah</td>
            <td style="padding:4px 6px; vertical-align: top;">: <?= $jumlah_pindah ?></td>
        </tr>
    </table>


    <p class="isi">
        Adapun Permohonan Pindah Penduduk WNI yang bersangkutan sebagaimana terlampir. Demikian Surat Pengantar ini dibuat agar digunakan sebagaimana mestinya.
    </p>
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