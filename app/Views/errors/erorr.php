<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- AdminLTE Theme -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="error-page">
        <h2 class="headline text-danger">403</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Akses Ditolak!</h3>
            <p>
                Anda tidak memiliki izin untuk mengakses halaman ini.<br>
                <a href="<?= base_url('/') ?>">Kembali ke beranda</a>.
            </p>
        </div>
    </div>
</body>

</html>