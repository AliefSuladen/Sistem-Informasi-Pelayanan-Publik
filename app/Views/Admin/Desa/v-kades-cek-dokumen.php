<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-body">
            <h5>Detail Permohonan</h5>
            <p><strong>Nama Pengaju:</strong> <?= esc($permohonan['nama_user']) ?></p>
            <p><strong>Email:</strong> <?= esc($permohonan['email']) ?></p>
            <p><strong>Jenis Surat:</strong> <?= esc($permohonan['surat']) ?></p>
            <p><strong>Tanggal Pengajuan:</strong> <?= date('d-m-Y', strtotime($permohonan['created_at'])) ?></p>
            <p><strong>Status:</strong> <?= esc($permohonan['status']) ?></p>
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
    <!-- Tombol review surat & Cetak -->
    <form action="<?= base_url('kades-preview-surat') ?>" method="post" target="_blank">
        <input type="hidden" name="id_permohonan" value="<?= $permohonan['id_permohonan'] ?>">
        <button type="submit" class="btn btn-primary">Preview & Cetak</button>
    </form>

    <!-- Tombol Simpan Surat Setelah Preview -->
    <form action="<?= base_url('kades-terbitkan-surat') ?>" method="post">
        <button type="submit" class="btn btn-success mt-2">Terbitkan Surat</button>
    </form>

</div>
<?= $this->endSection() ?>