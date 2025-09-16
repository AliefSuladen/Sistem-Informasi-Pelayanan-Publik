<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>

<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">
                <span style="color:#007bff;">|</span> Berita Kecamatan
            </h3>
        </div>

        <div class="row g-3">
            <?php if (!empty($berita) && is_array($berita)): ?>
                <?php foreach ($berita as $item): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden" style="border-radius: 0.75rem;">
                            <?php
                            $images = !empty($item['gambar']) ? json_decode($item['gambar'], true) : [];
                            $firstImage = isset($images[0]) ? base_url('uploads/berita/' . $images[0]) : base_url('home/banner.jpg');
                            ?>
                            <a href="<?= base_url('detail-berita/' . $item['slug']) ?>" class="stretched-link"></a>
                            <img src="<?= $firstImage ?>" alt="<?= esc($item['judul']) ?>"
                                class="card-img-top" style="height:180px; object-fit:cover; border-top-left-radius:0.75rem; border-top-right-radius:0.75rem;">
                            <div class="card-body p-2">
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;"><?= esc($item['judul']) ?></h6>
                                <small class="text-muted"><?= date('d M Y', strtotime($item['created_at'])) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada berita terbaru.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>