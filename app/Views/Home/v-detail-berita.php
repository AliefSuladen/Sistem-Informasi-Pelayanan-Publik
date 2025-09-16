<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>

<section class="py-5" style="background-color: #f8fafc;">
    <?php if (!empty($berita)): ?>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Judul dan Tanggal -->
                <h2 class="fw-bold mb-2"><?= esc($berita['judul']) ?></h2>
                <p class="text-muted mb-4">
                    <?= date('d M Y', strtotime($berita['created_at'])) ?>
                    | <?= esc($berita['penulis']) ?>
                </p>
                <img src="<?= !empty($berita['gambar']) ? base_url('uploads/berita/' . json_decode($berita['gambar'])[0]) : base_url('home/banner.jpg') ?>"
                    class="img-fluid rounded mb-4" alt="<?= esc($berita['judul']) ?>">
                <div class="berita-content" style="line-height: 1.8;">
                    <?= $berita['isi'] ?>
                </div>


            </div>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Berita tidak ditemukan.</p>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>