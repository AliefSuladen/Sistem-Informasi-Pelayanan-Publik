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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahJenis">
                <i class="fas fa-plus-circle"></i> Tambah Jenis Surat
            </button>
        </div>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-jenis" class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Jenis Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jenis_surat)): ?>
                            <?php $no = 1;
                            foreach ($jenis_surat as $jenis): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($jenis['surat']) ?></td>
                                    <td>
                                        <form action="<?= base_url('kecamatan-delete-jenis/' . $jenis['id_jenis']) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus jenis surat ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada jenis surat yang ditambahkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jenis Surat -->
<div class="modal fade" id="modalTambahJenis" tabindex="-1" role="dialog" aria-labelledby="modalTambahJenisLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('kecamatan-add-jenis-surat') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Surat</h5>
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
                        <label for="surat">Nama Jenis Surat</label>
                        <input type="text" name="surat" id="surat" class="form-control" required>
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