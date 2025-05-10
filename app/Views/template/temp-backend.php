<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">

  <!-- AdminLTE -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- DataTables Export (CDN untuk PDF/Excel support) -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-light bg-white">
      <div class="container-fluid d-flex justify-content-between align-items-center">

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
            </a>
          </li>
        </ul>

        <!-- Judul Aplikasi -->
        <span class="navbar-brand font-weight-bold text-info text-dark">
          <i class="fas fa-landmark mr-2 text-dark"></i>
          <span class="d-none d-sm-inline">Elektronik Layanan Administrasi Informasi Sistem</span>
          <span class="d-inline d-sm-none">e-LAIS</span>
        </span>

        <!-- Menu Kanan -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-dark" href="<?= base_url('tentang') ?>">
              <i class="fas fa-user"></i> Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="<?= base_url('logout') ?>">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </li>
        </ul>

      </div>
    </nav>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="<?= base_url() ?>/uploads/dokumen/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold text-white">e-LAIS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('uploads/profil/' . session()->get('foto')) ?>"
              class="img-circle elevation-2"
              alt="User Image"
              style="width: 45px; height: 45px; object-fit: cover;">
          </div>
          <div class="info">
            <div class="info">
              <a href="#" class="d-block"><?= session()->get('nama_user') ?></a>
              <a href="#" class="d-block"> <?= session()->get('role') ?></a>
            </div>

          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            $current_url = service('uri')->getSegment(1); // Misal: 'kecamatan-data-admin'
            ?>

            <?php if (session()->get('role') == 'Admin Kecamatan'): // Role Admin Kecamatan 
            ?>
              <!-- Menu untuk Pengajuan Permohonan hanya untuk Admin Kecamatan -->
              <li class="nav-item">

                <a href="<?= base_url('admin-kecamatan') ?>" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('daftar-pengajuan-surat') ?>" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Daftar Permohonan</p>
                </a>
              </li>
              <!-- Manajemen Data -->
              <li class="nav-item has-treeview <?= in_array($current_url, ['kecamatan-data-desa', 'kecamatan-data-admin', 'kecamatan-jenis-surat', 'kecamatan-laporan']) ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Manajemen Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('kecamatan-data-desa') ?>" class="nav-link <?= $current_url == 'kecamatan-data-desa' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Desa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('kecamatan-data-admin') ?>" class="nav-link <?= $current_url == 'kecamatan-data-admin' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Admin Desa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('kecamatan-jenis-surat') ?>" class="nav-link <?= $current_url == 'kecamatan-jenis-surat' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Jenis Surat</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('kecamatan-laporan') ?>" class="nav-link <?= $current_url == 'kecamatan-laporan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Laporan</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif; ?>
            <?php if (session()->get('role') == 'Admin Desa'): // Role Admin Kecamatan 
            ?>
              <!-- Menu untuk Pengajuan Permohonan hanya untuk Admin Kecamatan -->
              <li class="nav-item">
                <a href="<?= base_url('admin-desa') ?>" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('daftar-pengajuan') ?>" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Daftar Permohonan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('data-warga') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Data Warga</p>
                </a>
              </li>

            <?php endif; ?>
            <?php if (session()->get('role') == 'Masyarakat'): // Role Admin Kecamatan 
            ?>
              <!-- Menu untuk Pengajuan Permohonan hanya untuk Admin Kecamatan -->
              <li class="nav-item">
                <a href="<?= base_url('masyarakat') ?>" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Daftar Permohonan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('pengajuan-surat') ?>" class="nav-link">
                  <i class="nav-icon fas fa-file-signature"></i>
                  <p>Ajukan Permohonan</p>
                </a>
              </li>

            <?php endif; ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <div class="content">
        <div class="container-fluid">
          <div class="row">

            <?= $this->renderSection('content') ?>




          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script>
    // Menghilangkan flashdata setelah 3 detik (3000 ms)
    setTimeout(function() {
      const flashAlert = document.getElementById('flash-alert');
      if (flashAlert) {
        // Fade out secara perlahan
        flashAlert.style.transition = 'opacity 0.5s';
        flashAlert.style.opacity = '0';
        setTimeout(() => flashAlert.remove(), 500); // Hapus dari DOM setelah transisi selesai
      }
    }, 3000);
  </script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/AdminLTE/dist/js/adminlte.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Export Dependencies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  <?= $this->renderSection('script') ?>

</body>

</html>