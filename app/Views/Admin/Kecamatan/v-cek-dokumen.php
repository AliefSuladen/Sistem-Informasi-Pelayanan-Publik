<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-body">
            <h5>Detail Permohonan Legalisasi <strong><?= esc($permohonan['surat']) ?></strong> </h5>
            <p><strong>Nama Pengaju:</strong> <?= esc($permohonan['nama_user']) ?></p>
            <p><strong>N I K:</strong> <?= esc($permohonan['nik']) ?></p>
            <p><strong>Desa:</strong> <?= esc($permohonan['nama_desa']) ?></p>
            <p><strong>Tanggal Pengajuan:</strong> <?= date('d-m-Y', strtotime($permohonan['created_at'])) ?></p>

            <h5 class="text-center text-primary fw-bold mt-4 p-3 border rounded shadow-sm">
                <?= esc($permohonan['surat']) ?> Telah Dikeluarkan Oleh Kepala Desa <?= esc($permohonan['nama_desa']) ?> <br>
                Dengan Nomor: <?= esc($permohonan['nomor_surat']) ?>
            </h5>
            <div class="text-center mt-3">
                <a href="<?= base_url('uploads/dokumen/' . $permohonan['file_surat']) ?>" target="_blank" class="btn btn-primary btn-sm">
                    <i class="fas fa-file"></i> Lihat Surat
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Dokumen Pendukung</h5>
            <?php if (empty($dokumenPendukung)): ?>
                <div class="alert alert-warning">Tidak ada dokumen pendukung yang ditemukan.</div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($dokumenPendukung as $index => $dokumen): ?>
                        <div class="col-md-4 text-center mb-3">
                            <img src="<?= base_url('uploads/dokumen/' . $dokumen['file_dokumen']); ?>"
                                alt="<?= $dokumen['nama_dokumen']; ?>"
                                class="img-fluid img-thumbnail"
                                style="max-height:200px;">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="alert alert-info mt-3 text-center">
        Pastikan semua dokumen pendukung telah lengkap sebelum melakukan validasi!
    </div>
    <div class="d-flex justify-content-between align-items-start mb-3">
        <a href="<?= base_url('daftar-pengajuan-surat'); ?>" class="btn btn-secondary me-2">← Kembali</a>
        <form action="<?= base_url('kecamatan-terima-preview') ?>" method="post" target="_blank">
            <input type="hidden" name="id_permohonan" value="<?= $permohonan['id_permohonan'] ?>">
            <button type="submit" class="btn btn-success"> Terima & Preview</button>
        </form>

        <form action="<?= base_url('kecamatan-terbitkan-surat') ?>" method="post">
            <button type="submit" class="btn btn-primary"> Terbitkan Surat</button>
        </form>

    </div>
    <form action="<?= base_url('kecamatan-tolak-berkas/' . $permohonan['id_permohonan']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id_permohonan" value="<?= $permohonan['id_permohonan'] ?>">

        <div class="form-group mb-3">
            <label for="alasan_penolakan"><i class="fas fa-file-alt text-danger"></i> <strong>Alasan Penolakan</strong></label>
            <textarea name="alasan_penolakan" class="form-control" rows="3" placeholder="Masukkan alasan penolakan" required></textarea>
        </div>

        <button type="submit" class="btn btn-danger w-100"> Tolak Permohonan</button>
    </form>




    <?= $this->endSection() ?>