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
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <h3>halaman admin</h3>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= ('logout') ?>">
            <i class="fas fa-lock"></i> Logout
          </a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('Admin') ?>" class="brand-link">
        <img src="<?= base_url() ?>/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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

            <?php if (session()->get('role') == 'Admin Kecamatan'): // Role Admin Kecamatan 
            ?>
              <!-- Menu untuk Pengajuan Permohonan hanya untuk Admin Kecamatan -->
              <li class="nav-item">

                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('daftar-pengajuan-surat') ?>" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>Pengajuan Permohonan</p>
                </a>
              </li>
            <?php endif; ?>
            <?php if (session()->get('role') == 'Admin Desa'): // Role Admin Kecamatan 
            ?>
              <!-- Menu untuk Pengajuan Permohonan hanya untuk Admin Kecamatan -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('daftar-pengajuan') ?>" class="nav-link">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>Pengajuan Permohonan</p>
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
</body>

</html>