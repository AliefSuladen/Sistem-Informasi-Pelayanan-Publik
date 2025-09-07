<?php function tanggalIndo($tanggal)
{
    $bulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
    $tanggalArray = explode('-', $tanggal);
    if (count($tanggalArray) === 3) {
        return $tanggalArray[2] . ' ' . $bulan[(int)$tanggalArray[1]] . ' ' . $tanggalArray[0];
    } else {
        return 'Tanggal tidak valid';
    }
}
$nama = $permohonan['nama_user'];
$tempat_lahir = $permohonan['tempat_lahir'];
$tgl_lahir = $permohonan['tgl_lahir'];
$nik = $permohonan['nik'];
$jenisKelamin = $permohonan['kelamin'];
$agama = $permohonan['agama'];
$tujuan = $permohonan['tujuan_skck'];
$tanggalSurat = tanggalIndo(date('Y-m-d'));
$nomorSurat = model('Modelpermohonan')->getNomorSuratPengantarSKCK();
$logoSrc = '';
$logoFile = FCPATH . 'uploads/logo.jpg';
if (file_exists($logoFile)) {
    $logoData = file_get_contents($logoFile);
    $logoBase64 = base64_encode($logoData);
    $logoSrc = 'data:image/jpeg;base64,' . $logoBase64;
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar SKCK</title>
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


        .kop {
            font-size: 14pt;
            margin: 0;
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
        <div style="display: table-cell; width: 100px; vertical-align: middle;"> <img src="<?= $logoSrc ?>" style="width: 80px; height: auto; margin: left 20px;"> </div>
        <div style="display: table-cell; text-align: center; vertical-align: middle;">
            <h4 style="margin:0;">PEMERINTAH KABUPATEN MUSI BANYUASIN</h4>
            <h4 style="margin:0;">KECAMATAN LAIS</h4>
            <h3 style="margin:0;">DESA TELUK KIJING III</h3>
            <p style="margin:0;">Alamat : Jl. Betung - Sekayu Km 76 Talang Duku Kode Pos 30757</p>
        </div>
    </div>

    <!-- Nomor & Tujuan -->
    <div>
        <table>
            <tr>
                <td style="width:20px;">Nomor</td>
                <td>: <?= $nomorSurat ?> </td>
                <td style="width:320px;">Teluk Kijing III, <?= $tanggalSurat ?></td>
            </tr>
            <tr>
                <td>Sifat</td>
                <td>: Biasa</td>
                <td>Kepada</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>: ---</td>
                <td>Yth. Bapak Kapolsek Lais</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>: Rekomendasi SKCK</td>
                <td>Di Lais</td>
            </tr>
        </table>
    </div>
    <p style="margin-left: 100px;">Menindaklanjuti permohonan, saudara/i :</p>
    <table style="margin-left: 110px; border-collapse: collapse; line-height: 1.2;">
        <tr>
            <td style="width:150px; padding:2px 4px;">Nama lengkap</td>
            <td style="padding:2px 4px;">: <?= $nama ?></td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">N I K</td>
            <td style="padding:2px 4px;">: <?= $nik ?></td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">Jenis Kelamin</td>
            <td style="padding:2px 4px;">: <?= $jenisKelamin ?></td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">Tempat Tgl. Lahir</td>
            <td style="padding:2px 4px;">: <?= $tempat_lahir ?>, <?= tanggalIndo($permohonan['tgl_lahir']) ?></td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">Suku/Bangsa</td>
            <td style="padding:2px 4px;">: Indonesia</td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">Agama</td>
            <td style="padding:2px 4px;">: <?= $agama ?></td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">Pekerjaan</td>
            <td style="padding:2px 4px;">: <?= $permohonan['pekerjaan'] ?></td>
        </tr>
        <tr>
            <td style="padding:2px 4px;">Alamat lengkap</td>
            <td style="padding:2px 4px;">: <?= $permohonan['alamat'] ?></td>
        </tr>
    </table>

    <p class="isi">
        Dengan ini kami mohon kepada Bapak kiranya dapat menerbitkan Surat Keterangan Catatan Kepolisian (SKCK)
        untuk yang bersangkutan <?= $tujuan ?>.
    </p>

    <p class="isi">
        Sebagai bahan pertimbangan yang bersangkutan memang benar penduduk Desa Teluk Kijing III Kecamatan Lais
        dan benar berkelakuan baik.
    </p>

    <p class="isi">
        Demikian harapan kami kiranya Bapak berkenan untuk mengabulkannya, atas perkenannya diucapkan terima kasih.
    </p>


    <!-- Tanda Tangan -->
    <div class="signature">
        <p>KEPALA DESA TELUK KIJING III</p>
        <br><br>
        <p class="bold underline">YUPANSER AHMAD, SE</p>
    </div>

    <!-- QR Code (opsional) -->
    <?php if (!empty($qrCode)): ?>
        <div style="margin-top:50px; margin: left 50px;">
            <p><small>Scan QR untuk verifikasi surat ini:</small></p>
            <img src="<?= $qrCode ?>" width="100">
        </div>
    <?php endif; ?>

</body>

</html>