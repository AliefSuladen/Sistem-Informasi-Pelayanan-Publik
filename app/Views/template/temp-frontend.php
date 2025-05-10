<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-LAIS | Pelayanan Surat Online</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE Theme -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand-md shadow-sm fixed-top"
      style="background-color: rgba(255, 255, 255, 0.9); box-shadow: 0 2px 6px rgba(0,0,0,0.05); backdrop-filter: blur(5px);">
      <div class="container">

        <!-- Logo Kiri -->
        <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
          <img src="<?= base_url() ?>/uploads/dokumen/logo.png" alt="Logo" class="img-circle elevation-2"
            style="width:40px; height:50px; margin-right:10px;">
          <div class="d-flex flex-column lh-sm">
            <span class="text-dark font-weight-bold" style="font-size: 16px;">Kecamatan Lais</span>
            <span class="text-secondary" style="font-size: 13px;">Musi Banyuasin</span>
          </div>
        </a>

        <!-- Toggle Button (Mobile) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-dark"></i>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarCollapse">

          <!-- Tengah -->
          <ul class="navbar-nav mx-auto text-center">
            <li class="nav-item">
              <a href="<?= base_url() ?>" class="nav-link text-dark font-weight-normal">Beranda</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('formpengajuan') ?>" class="nav-link text-dark font-weight-normal">Pelayanan</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('tentang') ?>" class="nav-link text-dark font-weight-normal">Tentang</a>
            </li>
          </ul>

          <!-- Kanan -->
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item">
              <a href="<?= base_url('login') ?>" class="btn btn-outline-primary btn-sm rounded-pill shadow-sm">
                <i class="fas fa-sign-in-alt mr-1"></i> Masuk
              </a>
            </li>
          </ul>

        </div>
      </div>
    </nav>


    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Page Header -->
      <div class="content-header">
        <div class="container">
          <!-- Optional: Header Content -->
        </div>
      </div>

      <!-- Main Content -->
      <div class="content">
        <div class="content-wrapper" style="margin-top: 50px;">

          <div class="container">
            <?= $this->renderSection('content') ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer text-sm">
      <div class="float-right d-none d-sm-inline">
        Kecamatan Lais, Muba
      </div>
      <strong>&copy; <?= date('Y') ?> <a href="<?= base_url() ?>">E-LAIS</a>.</strong> Semua hak dilindungi.
    </footer>

  </div>
  <!-- ./wrapper -->

  <!-- Scripts -->
  <script src="<?= base_url() ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>