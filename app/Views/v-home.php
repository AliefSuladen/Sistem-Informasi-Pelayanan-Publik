<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>
<section style="background: linear-gradient(135deg, #0A3D62, #1B5E20); padding: 50px 0;">
    <div id="bannerCarousel" class="carousel slide mx-auto mb-4 shadow rounded overflow-hidden"
        data-ride="carousel" style="max-width: 1500px;">
        <ol class="carousel-indicators">
            <li data-target="#bannerCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#bannerCarousel" data-slide-to="1"></li>
            <li data-target="#bannerCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('uploads/banner/banner1.jpg') ?>"
                    class="d-block w-100 banner-img" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('uploads/banner/banner2.jpg') ?>"
                    class="d-block w-100 banner-img" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('uploads/banner/banner3.jpg') ?>"
                    class="d-block w-100 banner-img" alt="Banner 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bg-secondary rounded-circle p-2" aria-hidden="true"></span>
            <span class="sr-only">Sebelumnya</span>
        </a>
        <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon bg-secondary rounded-circle p-2" aria-hidden="true"></span>
            <span class="sr-only">Berikutnya</span>
        </a>
    </div>

    <div class="text-center mt-4">
        <img src="<?= base_url() ?>/uploads/dokumen/logo.png"
            alt="Logo Kecamatan"
            class="mb-3"
            style="max-width: 150px; height:auto;">
        <h3 class="font-weight-bold text-white mb-2">PEMERINTAH KABUPATEN MUSI BANYUASIN</h3>
        <h2 class="font-weight-bold text-white">KECAMATAN LAIS</h2>
    </div>
</section>

<section style="background: linear-gradient(#FDFAF6); padding: 60px 20px; color: black;">
    <div class="container text-center">
        <h2 class="font-weight-bold mb-3">Selamat Datang di <span class="text-warning">E-LAIS</span></h2>
        <p class="lead mb-4">
            Layanan Administrasi Surat Online <br>
            <strong>Kecamatan Lais, Kabupaten Musi Banyuasin</strong>
        </p>
    </div>
</section>

<section class="py-5" style="background-color: #FAF6E9;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="font-weight-bold text-dark mb-0">
                <span style="border-left: 5px solid #007bff; padding-left: 10px;">Pelayanan Online</span>
            </h3>
            <a href="<?= base_url('formpengajuan') ?>" class="text-primary font-weight-bold">
                Selengkapnya →
            </a>
        </div>
        <div class="row">
            <?php if (!empty($layanan)): ?>
                <?php foreach ($layanan as $item): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="text-center p-3">
                                <img src="<?= base_url('home/surat.png') ?>"
                                    class="card-img-top"
                                    alt="<?= esc($item['surat']) ?>"
                                    style="max-width: 120px; height: auto;">
                                <div class="card-body text-center">
                                    <p class="card-text font-weight-bold"><?= esc($item['surat']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">Layanan tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>


<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="font-weight-bold text-dark mb-0">
                <span style="border-left: 5px solid #007bff; padding-left: 10px;">Berita Terbaru</span>
            </h3>
            <a href="<?= base_url('berita') ?>" class="text-primary font-weight-bold">Lihat Lainnya →</a>
        </div>
        <div class="row g-4">
            <?php if (!empty($berita) && is_array($berita)): ?>
                <?php foreach (array_slice($berita, 0, 3) as $item): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                            <?php
                            $images = !empty($item['gambar']) ? json_decode($item['gambar'], true) : [];
                            $firstImage = isset($images[0]) ? base_url('uploads/berita/' . $images[0]) : base_url('home/banner.jpg');
                            ?>
                            <a href="<?= base_url('detail-berita/' . $item['slug']) ?>" class="stretched-link"></a>
                            <img src="<?= $firstImage ?>" alt="<?= esc($item['judul']) ?>" class="card-img h-100 object-fit-cover">
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                                <h6 class="fw-bold text-white mb-1"><?= esc($item['judul']) ?></h6>
                                <small class="text-light"><?= date('d M Y', strtotime($item['created_at'])) ?></small>
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
    </div>
</section>









<?= $this->endSection() ?>