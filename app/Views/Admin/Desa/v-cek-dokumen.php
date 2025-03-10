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

    <a href="<?= base_url('daftar-pengajuan'); ?>" class="btn btn-secondary">Kembali</a>
    <!-- Tombol Terima Berkas -->
    <?php if ($permohonan['id_status'] != 2): ?> <!-- Tombol hanya tampil jika status belum diverifikasi -->
        <form action="<?= base_url('desa/terima-berkas/' . $permohonan['id_permohonan']) ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-success mt-3">Terima Berkas</button>
        </form>
    <?php else: ?>
        <p class="text-success mt-3">Permohonan sudah diverifikasi.</p>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>