<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">

    </div>
</section>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAdmin">
                <i class="fas fa-plus-circle"></i> Tambah Admin
            </button>
        </div>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-admin" class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Email</th>
                            <th>Desa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($admin_desa)): ?>
                            <?php $no = 1;
                            foreach ($admin_desa as $admin): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($admin['nama_user']) ?></td>
                                    <td><?= esc($admin['email']) ?></td>
                                    <td><?= esc($admin['nama_desa']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada admin desa yang terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="modalTambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('kecamatan-add-admin') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Admin Desa</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <?php if (session('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="nama_user">Nama Lengkap</label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Admin</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password Sementara</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="desa">Pilih Desa</label>
                        <select name="id_desa" id="desa" class="form-control" required>
                            <option value="">-- Pilih Desa --</option>
                            <?php foreach ($daftar_desa as $desa): ?>
                                <option value="<?= $desa['id_desa'] ?>"><?= esc($desa['nama_desa']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Profil</label>
                        <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>