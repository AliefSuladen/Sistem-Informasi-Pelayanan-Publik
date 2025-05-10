<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>

<!-- Carousel -->
<div id="bannerCarousel" class="carousel slide mb-5 shadow rounded-lg overflow-hidden" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#bannerCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#bannerCarousel" data-slide-to="1"></li>
        <li data-target="#bannerCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('uploads/banner/banner1.jpg') ?>" class="d-block w-100" alt="Banner 1" style="height: 480px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('uploads/banner/banner2.jpg') ?>" class="d-block w-100" alt="Banner 2" style="height: 480px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('uploads/banner/banner3.jpg') ?>" class="d-block w-100" alt="Banner 3" style="height: 480px; object-fit: cover;">
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

<!-- Jumbotron -->
<div class="jumbotron bg-white p-5 shadow rounded-lg">
    <h1 class="display-5 font-weight-bold text-dark">Selamat Datang di <span class="text-primary">E-LAIS</span></h1>
    <p class="lead text-muted">Layanan Administrasi Surat Online <strong>Kecamatan Lais, Musi Banyuasin</strong></p>
    <hr class="my-3">
    <p class="text-secondary">Gunakan platform ini untuk mengajukan berbagai jenis surat secara cepat dan mudah tanpa harus datang ke kantor kecamatan.</p>
    <a class="btn btn-outline-primary btn-lg" href="<?= base_url('formpengajuan') ?>" role="button">
        <i class="fas fa-envelope-open-text mr-2"></i>Ajukan Surat
    </a>
</div>

<!-- Sambutan Camat -->
<div class="row mb-5">
    <div class="col-md-3 text-center">
        <img src="<?= base_url('uploads/foto_camat.jpg') ?>" alt="Foto Camat" class="img-thumbnail rounded-circle shadow-sm" style="width: 200px; height: 220px; object-fit: cover;">
        <h6 class="mt-3 font-weight-bold text-dark mb-0">Zukar, Skm., M.SI</h6>
        <p class="text-muted small">PLT CAMAT LAIS</p>
    </div>
    <div class="col-md-9">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title font-weight-bold text-dark">Sambutan Camat</h5>
                <p class="card-text text-justify text-secondary" style="line-height: 1.7;">
                    Assalamu'alaikum Warahmatullahi Wabarakatuh.<br><br>
                    Selamat datang di website layanan administrasi surat online Kecamatan Lais, Kabupaten Musi Banyuasin. Dengan hadirnya platform E-LAIS ini, kami berkomitmen untuk memberikan pelayanan yang cepat, transparan, dan mudah dijangkau oleh seluruh masyarakat. Semoga layanan ini dapat membantu mempercepat urusan administrasi tanpa harus datang langsung ke kantor kecamatan.
                    <br><br>
                    Wassalamu’alaikum Warahmatullahi Wabarakatuh.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Kartu Informasi -->
<div class="row mb-5">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <i class="fas fa-id-card fa-2x text-primary mb-3"></i>
                <h5 class="card-title text-dark font-weight-bold">Surat Keterangan</h5>
                <p class="card-text text-muted">Ajukan surat keterangan domisili, usaha, belum menikah, dan lainnya secara online.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <i class="fas fa-user-check fa-2x text-success mb-3"></i>
                <h5 class="card-title text-dark font-weight-bold">Mudah & Cepat</h5>
                <p class="card-text text-muted">Tanpa antrean panjang, cukup dari rumah, surat akan diproses oleh petugas desa.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center">
                <i class="fas fa-shield-alt fa-2x text-warning mb-3"></i>
                <h5 class="card-title text-dark font-weight-bold">Aman & Terverifikasi</h5>
                <p class="card-text text-muted">Data Anda aman dan surat akan diterbitkan dengan QR Code sebagai bukti keabsahan.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>