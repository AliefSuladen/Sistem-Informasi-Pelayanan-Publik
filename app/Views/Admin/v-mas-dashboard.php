<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">

    </div>
</section>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pengajuan Permohonan</h3>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($permohonan) && is_array($permohonan)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($permohonan as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['surat']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                    <td>
                                        <?php
                                        $badgeClass = match ($item['status']) {
                                            'Pending' => 'badge-danger',
                                            'Diverifikasi Pihak Desa' => 'badge-primary',
                                            'Selesai' => 'badge-success',
                                            'Ditolak' => 'badge-secondary',
                                        };
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= esc($item['status']) ?></span>
                                    </td>
                                    <td>
                                        <?php if ($item['status'] === 'Selesai'): ?>
                                            <a href="<?= base_url('masyarakat-download/' . $item['id_permohonan']) ?>" class="btn btn-success btn-sm">
                                                <i class="fas fa-download"></i> Unduh Dokumen
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($item['status'] === 'Ditolak'): ?>
                                            <a href="<?= base_url('masyarakat-penolakan/' . $item['id_permohonan']) ?>" class="btn btn-secondary btn-sm">
                                                <i class="fas fa-eye"> Lihat Pengajuan</i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengajuan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>