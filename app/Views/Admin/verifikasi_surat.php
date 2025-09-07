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

    $tanggal = substr($tanggal, 0, 10); // Ambil hanya YYYY-MM-DD
    $tanggalArray = explode('-', $tanggal);
    if (count($tanggalArray) === 3) {
        return $tanggalArray[2] . ' ' . $bulan[(int)$tanggalArray[1]] . ' ' . $tanggalArray[0];
    } else {
        return 'Tanggal tidak valid';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
            background: #f7f7f7;
            margin: 0;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 22px;
        }

        .status {
            font-size: 20px;
            font-weight: bold;
            margin: 20px auto;
            padding: 15px 25px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 90%;
        }

        .valid {
            color: #155724;
            background: rgba(40, 167, 69, 0.15);
            border: 2px solid rgba(40, 167, 69, 0.4);
        }

        .invalid {
            color: #721c24;
            background: rgba(220, 53, 69, 0.15);
            border: 2px solid rgba(220, 53, 69, 0.4);
        }

        .detail {
            text-align: left;
            display: inline-block;
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            font-size: 14px;
            max-width: 95%;
        }

        .detail p {
            margin: 8px 0;
        }

        @media (min-width: 768px) {
            h2 {
                font-size: 28px;
            }

            .status {
                font-size: 24px;
            }

            .detail {
                font-size: 16px;
                padding: 20px;
                max-width: 60%;
            }
        }
    </style>
</head>

<body>
    <h2>Hasil Verifikasi Surat</h2>

    <p class="status <?= ($status == '✅ Valid') ? 'valid' : 'invalid' ?>">
        <?= $status ?>
    </p>

    <?php if ($status == '✅ Valid' && $surat): ?>
        <div class="detail">
            <p><strong>Nomor Surat:</strong> <?= $surat['nomor_surat'] ?? '-' ?></p>
            <p><strong>Nama Pemohon:</strong> <?= $surat['nama_user'] ?? '-' ?></p>
            <p><strong>Jenis Surat:</strong> <?= $surat['surat'] ?? '-' ?></p>
            <p><strong>Tanggal Permohonan:</strong> <?= tanggalIndo($surat['created_at']) ?? '-' ?></p>
            <p><strong>Tanggal Diterbitkan:</strong> <?= tanggalIndo($surat['updated_at']) ?? '-' ?></p>
        </div>
    <?php endif; ?>
</body>

</html>