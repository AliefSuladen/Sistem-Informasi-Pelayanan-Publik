<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | E-LAIS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">

    <style>
        body {
            background: url("<?= base_url('uploads/profil/logo_bg.png') ?>") no-repeat center center fixed;
            background-size: cover;
            position: relative;
            z-index: 1;
            background-position: center 40%;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .login-box {
            max-width: 420px;
        }

        .login-logo a {
            font-weight: bold;
            color: #ffffff;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 1rem;
        }

        .alert ul {
            margin-bottom: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .text-small {
            font-size: 0.875rem;
        }

        .login-box-msg {
            color: #666;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- Logo -->
        <div class="login-logo">
            <a href="<?= base_url() ?>"><i class="fas fa-university"></i> <b>E</b>-LAIS</a>
        </div>

        <div class="card card-outline card-primary shadow">
            <div class="card-header text-center">
                <h3 class="card-title font-weight-bold">Selamat Datang</h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-muted">Silakan login untuk melanjutkan</p>
                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('pesan') ?></div>
                <?php endif ?>

                <?= form_open('login/process') ?>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-6">
                        <a href="<?= base_url() ?>" class="text-small"><i class="fa fa-home"></i> Halaman Utama</a>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
                <?= form_close() ?>
                <hr>
                <p class="mb-0 text-center">
                    <a href="<?= base_url('register') ?>" class="text-center">Belum punya akun? Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url() ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>