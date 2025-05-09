<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Data Desa Kecamatan Lais</h1>
            </div>
        </div>
    </div>
</section>

<div class="col-md-12">
    <div class="card">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-desa" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Desa</th>
                            <th>Jumlah Warga Terdaftar Sistem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($desa) && is_array($desa)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($desa as $d): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($d['nama_desa']) ?></td>
                                    <td><?= esc($d['jumlah_warga']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Tidak ada data desa.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>