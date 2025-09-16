<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>


<section style="background: linear-gradient(#FAF6E9); padding: 60px 20px; color: black;">
    <div class="container-fluid text-center">
        <h3 class="fw-bold mb-4">STRUKTUR ORGANISASI KECAMATAN LAIS</h3>
        <div class="row justify-content-center">
            <div class="col-10">
                <img src="<?= base_url('home/struktur.png') ?>"
                    alt="Struktur Organisasi"
                    class="img-fluid rounded shadow"
                    style="width: 100%; height:auto;">
            </div>
        </div>
    </div>
</section>

<section style="background-color: #FAF6E9; padding: 60px 20px;">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">TENTANG KECAMATAN LAIS</h2>
        <p class="lead text-center mb-5">
            Kecamatan Lais adalah salah satu kecamatan di Kabupaten Musi Banyuasin, Sumatera Selatan.
            Kecamatan ini memiliki berbagai layanan administrasi surat online yang mempermudah masyarakat dalam mengurus berbagai keperluan administrasi.
        </p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm rounded p-4 h-100">
                    <h3 class="fw-bold mb-3 text-center">Visi</h3>
                    <p class="text-center">
                        Meningkatkan kualitas kehidupan beragama dalam mewujudkan masyarakat kecamatan Lais beriman dan bertaqwa.
                        Meningkatkan kualitas pendidikan dan kesehatan yang merata dan terjangkau. Meningkatkan ekonomi kerakyatan yang berbasis agribisnis.
                        Meningkatkan pelayanan aparatur bagi pemenuhan pelayanan publik.
                        Optimalisasi Otonomi melalui Pemberdayaan masyarakat Meningkatkan Pembangunan Infrastruktur yang Proporsional, berkualitas dan berkelanjutan
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow-sm rounded p-4 h-100">
                    <h3 class="fw-bold mb-3 text-center">Misi</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"> Menyediakan layanan administrasi yang mudah diakses secara online.</li>
                        <li class="mb-2"> Meningkatkan transparansi dan akuntabilitas pelayanan publik.</li>
                        <li class="mb-2"> Mengoptimalkan sumber daya aparatur untuk pelayanan terbaik.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Alur Pelayanan -->
<section style="background: linear-gradient(#D9DFC6); padding: 60px 20px; color: black;">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">ALUR PELAYANAN SURAT ONLINE</h2>
        <div class="row justify-content-center g-4">
            <div class="col-10">
                <img src="<?= base_url('home/alur.png') ?>" alt="Alur Pelayanan" class="img-fluid rounded shadow" style="width:100%; height:auto;">
            </div>
        </div>
    </div>
</section>

<section style="background-color: #FAF6E9; padding: 60px 20px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="fw-bold text-center mb-4">KONTAK KAMI</h2>

                <div class="row justify-content-center g-4">
                    <!-- Info Kontak Kecil -->
                    <div class="col-md-3">
                        <div class="card shadow-sm rounded p-4 h-100 d-flex flex-column justify-content-center text-center">
                            <p class="mb-2"><strong>Alamat:</strong><br>
                                Jl. Raya Kecamatan Lais, Kabupaten Musi Banyuasin, Sumatera Selatan
                            </p>
                            <p class="mb-2"><strong>Telepon & Email:</strong><br>
                                (0711) xxx-xxxx | kecamatanlais@mbkab.go.id
                            </p>
                            <p class="mb-0"><strong>Jam Operasional:</strong><br>
                                Senin - Jumat, 08:00 - 16:00
                            </p>
                        </div>
                    </div>



                    <!-- Peta Lebih Besar -->
                    <div class="col-md-9">
                        <div class="shadow-sm rounded" style="width: 100%; height: 550px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2915.445032846117!2d104.09470133377621!3d-2.87336992689624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3af074188559db%3A0x6943d57c55b539e5!2sKantor%20Camat%20Lais!5e1!3m2!1sid!2sid!4v1758041868276!5m2!1sid!2sid"
                                style="border:0; width:100%; height:100%;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<?= $this->endSection() ?>