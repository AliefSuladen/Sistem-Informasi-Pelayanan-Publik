<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>


<section style="background: linear-gradient(#EFF3EA); padding: 60px 20px; color: black;">
    <div class="container text-center">
        <h3 class="fw-bold mb-4">ALUR PROSES PELAYANAN SURAT ONLINE</h3>
        <div class="row justify-content-center">
            <div class="col-12 ">
                <img src="<?= base_url('home/alur.png') ?>" alt="Alur Layanan"
                    class="img-fluid rounded shadow"
                    style="width: 100%; height: auto; max-width: 1000px;">
            </div>
        </div>
    </div>
</section>

<section style="background: linear-gradient(#D9DFC6); padding: 60px 20px; color: black;">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">JENIS SURAT PELAYANAN UMUM LINGKUP KECAMATAN LAIS</h2>
        <div class="row justify-content-center g-4">
            <?php foreach ($jenis_surat as $jenis): ?>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" style="padding-bottom: 20px;">
                    <div class="card shadow-sm border-0 h-100 text-center mx-auto" style="border-radius: 12px;">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <img src="<?= base_url('home/surat.png') ?>" alt="Icon Layanan"
                                class="mb-3" style="max-width:80px; width:100%; height:auto;">
                            <h6 class="fw-bold text-dark"><?= $jenis['surat'] ?></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section style="background: linear-gradient(#EFF3EA); padding: 60px 20px;">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Pengajuan Surat</h5>
            </div>
            <div class="card-body">

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('postpengajuan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" maxlength="16" pattern="\d{16}" placeholder="Masukkan 16 digit NIK" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="nama_user" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_user" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="contoh: user@email.com" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan pekerjaan" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" required>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                <option>Islam</option>
                                <option>Kristen</option>
                                <option>Katolik</option>
                                <option>Hindu</option>
                                <option>Buddha</option>
                                <option>Konghucu</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="id_desa" class="form-label">Desa</label>
                            <select class="form-control" name="id_desa" required>
                                <option value="">-- Pilih Desa --</option>
                                <?php foreach ($desa as $d): ?>
                                    <option value="<?= $d['id_desa'] ?>"><?= $d['nama_desa'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="id_jenis" class="form-label">Jenis Surat</label>
                            <select class="form-control" name="id_jenis" id="id_jenis" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                <?php foreach ($jenis_surat as $jenis): ?>
                                    <option value="<?= $jenis['id_jenis'] ?>"><?= $jenis['surat'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="extra-fields"></div>
                    <div class="mb-3" id="file-upload-area">
                        <label class="form-label">Unggah Dokumen Pendukung (KTP, KK, Pas Foto)</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" name="dokumen[]" multiple onchange="updateFileName(this)">
                            <button type="button" class="btn btn-success" id="add-file">Tambah File</button>
                        </div>
                        <small class="text-muted" id="file-name"></small>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Ajukan Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    document.getElementById('id_jenis').addEventListener('change', function() {
        const jenisSurat = this.value;
        const extraFields = document.getElementById('extra-fields');
        extraFields.innerHTML = '';

        let html = '';

        switch (jenisSurat) {
            case '1': // Surat Keterangan Tidak Mampu
                break;
            case '2': // Surat Domisili
                break;
            case '3': // Surat Kelahiran
                html = `<div class="mb-3">
                            <label for="nama_bayi" class="form-label">Nama Bayi</label>
                            <input type="text" class="form-control" name="nama_anak"  required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_bayi" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir"  required>
                        </div>

                         <div class="mb-3">
                            <label for="nama_bayi" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah"  required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_bayi" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu"  required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>`;
                break;
            case '4': // Surat Kematian
                html = `<div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_almarhum" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama_almarhum" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nik_almarhum" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik_almarhum" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ttl_alm" class="form-label">Tempat Tanggal Lahir</label>
                            <input type="text" class="form-control" name="ttl_alm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kelamin_alm" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="kelamin_alm" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="agama_alm" class="form-label">Agama</label>
                            <input type="text" class="form-control" name="agama_alm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pekerjaan_alm" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan_alm" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_alm" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat_alm" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sebab_kematian" class="form-label">Sebab</label>
                            <input type="text" class="form-control" name="sebab_kematian" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tempat" class="form-label">Tempat</label>
                            <input type="text" class="form-control" name="tempat" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_wafat" class="form-label">Tanggal Wafat</label>
                        <input type="date" class="form-control" name="tgl_wafat" required>
                    </div>`;
                break;
            case '5': // Surat Pengantar SKCK
                html = `<div class="mb-3">
                            <label for="keperluan" class="form-label">Keperluan</label>
                            <input type="text" class="form-control" name="tujuan_skck" required>
                        </div>`;
                break;
            case '6': // surat kehilangan
                html = `<div class="mb-3">
                            <label for="brg_hilang" class="form-label">Barang Yang Hilang</label>
                            <input type="text" class="form-control" name="brg_hilang" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_hilang" class="form-label">Tangal Kehilangan</label>
                            <input type="date" class="form-control" name="tgl_hilang" required>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_kehilangan" class="form-label">Tempat Hilang</label>
                            <input type="text" class="form-control" name="tempat_kehilangan" required>
                        </div>`;
                break;
            case '7':
                html = `<div class="mb-3">
                            <label for="nama_usaha" class="form-label"> Usaha</label>
                            <input type="text" class="form-control" name="nama_usaha" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                            <input type="text" class="form-control" name="alamat_usaha" required>
                        </div>`;
                break;
            case '8': //penganter pindah
                html = `<div class="mb-3">
                            <label for="nomor_kk" class="form-label"> Nomor Kartu Keluarga </label>
                            <input type="text" maxlength="16" class="form-control" name="nomor_kk" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_kk" class="form-label"> Nama Kepala Keluarga </label>
                            <input type="text" class="form-control" name="nama_kk" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_tujuan" class="form-label">Alamat Tujuan Pindah</label>
                            <input type="text" class="form-control" name="alamat_tujuan" required>
                        </div>
                        <div class="mb-3">
                            <label for="desa_tujuan" class="form-label">Desa/Kelurahan</label>
                            <input type="text" class="form-control" name="desa_tujuan" required>
                        </div>
                         <div class="mb-3">
                            <label for="kec_tujuan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" name="kec_tujuan" required>
                        </div>
                         <div class="mb-3">
                            <label for="kab_tujuan" class="form-label">Kabupaten</label>
                            <input type="text" class="form-control" name="kab_tujuan" required>
                        </div>
                         <div class="mb-3">
                            <label for="jumlah_pindah" class="form-label">Jumlah Keluarga Yang Pindah</label>
                            <input type="text" class="form-control" name="jumlah_pindah" required>
                        </div>
                        `;
                break;
        }

        extraFields.innerHTML = html;
    });

    function updateFileName(input) {
        const label = document.getElementById('file-name');
        if (input.files.length > 0) {
            label.textContent = `File terpilih: ${Array.from(input.files).map(f => f.name).join(', ')}`;
        } else {
            label.textContent = '';
        }
    }

    document.getElementById('add-file').addEventListener('click', function() {
        const container = document.createElement('div');
        container.classList.add('input-group', 'mb-2');

        container.innerHTML = `
            <input type="file" class="form-control" name="dokumen[]" multiple onchange="updateFileName(this)">
            <button type="button" class="btn btn-danger remove-file">Hapus</button>
        `;

        document.getElementById('file-upload-area').appendChild(container);

        container.querySelector('.remove-file').addEventListener('click', function() {
            container.remove();
        });
    });
</script>

<?= $this->endSection() ?>