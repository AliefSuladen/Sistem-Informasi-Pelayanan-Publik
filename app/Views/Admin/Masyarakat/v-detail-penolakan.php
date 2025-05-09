<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Detail Permohonan Surat</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Informasi Permohonan</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Nama Pemohon</th>
                    <td><?= $permohonan['nama_user'] ?? 'Tidak diketahui'; ?></td>
                </tr>
                <tr>
                    <th>Jenis Surat</th>
                    <td><?= $permohonan['surat'] ?? 'Tidak diketahui'; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= $permohonan['status'] ?? 'Tidak diketahui'; ?></td>
                </tr>
                <tr>
                    <th>Alasan</th>
                    <td><?= $permohonan['alasan_penolakan'] ?? 'Tidak diketahui'; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td><?= $permohonan['created_at'] ?? 'Tidak diketahui'; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Dokumen Pendukung</h5>
            <?php if (empty($dokumenPendukung)): ?>
                <div class="alert alert-warning">Tidak ada dokumen pendukung yang ditemukan.</div>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dokumenPendukung as $index => $dokumen): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= $dokumen['nama_dokumen']; ?></td>
                                <td>
                                    <a href="<?= base_url('uploads/dokumen/' . $dokumen['file_dokumen']); ?>" target="_blank" class="btn btn-primary btn-sm">Lihat Dokumen</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-start mb-3">
        <!-- Tombol Kembali -->
        <a href="<?= base_url('daftar-pengajuan'); ?>" class="btn btn-secondary me-2">
            ← Kembali
        </a>

        <!-- Tombol Ajukan Permohonan Baru -->
        <a href="<?= base_url('pengajuan-surat') ?>" class="btn btn-primary">
            + Ajukan Permohonan Baru
        </a>
    </div>




</div>
<?= $this->endSection() ?>