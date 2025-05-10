<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="jumbotron bg-light shadow-sm p-4 mt-3 mb-4 rounded">
    <h1 class="display-5 font-weight-bold text-primary">Tentang E-LAIS</h1>
    <p class="lead">Layanan Administrasi Surat Online Kecamatan Lais, Kabupaten Musi Banyuasin.</p>
    <hr class="my-3">
    <p>E-LAIS merupakan inisiatif digital yang bertujuan untuk meningkatkan kemudahan dan efisiensi layanan administrasi surat menyurat di wilayah Kecamatan Lais. Platform ini memungkinkan masyarakat mengajukan surat secara online tanpa perlu datang langsung ke kantor kecamatan.</p>
</div>

<!-- Visi Misi -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title text-primary">Visi</h5>
                <p class="card-text">Mewujudkan pelayanan publik yang efisien, transparan, dan mudah diakses oleh seluruh warga Kecamatan Lais melalui pemanfaatan teknologi digital.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title text-success">Misi</h5>
                <ul class="card-text pl-3">
                    <li>Meningkatkan kualitas pelayanan surat secara digital.</li>
                    <li>Mempermudah akses masyarakat terhadap layanan administrasi.</li>
                    <li>Menjamin kecepatan dan akurasi penerbitan surat.</li>
                    <li>Menjaga keamanan dan kerahasiaan data pemohon.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Tim -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title text-center">Tim Pengelola</h5>
        <p class="text-center">Berikut adalah tim yang bertanggung jawab dalam pengelolaan sistem E-LAIS:</p>
        <div class="row justify-content-center mt-3">
            <div class="col-md-3 text-center">
                <img src="<?= base_url('uploads/foto_camat.jpg') ?>" class="img-thumbnail rounded-circle shadow-sm mb-2" style="width: 150px; height: 170px; object-fit: cover;" alt="Camat">
                <h6 class="mb-0 font-weight-bold">Zukar, Skm., M.SI</h6>
                <small class="text-muted">PLT Camat Lais</small>
            </div>
            <!-- Tambah anggota tim lainnya di sini jika ada -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>