<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
    </div>
</section>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Silahkan Ajukan Permohonan Surat</h3>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('simpan-pengajuan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label for="id_jenis" class="form-label">Jenis Surat</label>
                    <select class="form-control" name="id_jenis" id="id_jenis" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        <?php foreach ($jenis_surat as $jenis) : ?>
                            <option value="<?= $jenis['id_jenis']; ?>"><?= $jenis['surat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="extra-fields"></div>
                <div class="mb-3" id="file-upload-area">
                    <label for="dokumen" class="form-label">Unggah Dokumen Pendukung (KTP, KK, Pas Foto)</label>
                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="dokumen[]" multiple onchange="updateFileName(this)">
                        <button type="button" class="btn btn-success" id="add-file">Tambah File</button>
                    </div>
                    <small class="text-muted" id="file-name"></small>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Permohonan</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('id_jenis').addEventListener('change', function() {
        const jenisSurat = this.value;
        const extraFields = document.getElementById('extra-fields');

        // Kosongkan field saat jenis surat berubah
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

    // Fungsi untuk menampilkan nama file yang dipilih
    function updateFileName(input) {
        if (input.files.length > 0) {
            document.getElementById('file-name').textContent = "File terpilih: " + input.files[0].name;
        } else {
            document.getElementById('file-name').textContent = "";
        }
    }

    document.getElementById('add-file').addEventListener('click', function() {
        const fileUploadArea = document.getElementById('file-upload-area');
        const newInputGroup = document.createElement('div');

        newInputGroup.classList.add('input-group', 'mb-2');
        newInputGroup.innerHTML = `
            <input type="file" class="form-control" name="dokumen[]" multiple onchange="updateFileName(this)">
            <button type="button" class="btn btn-danger remove-file">Hapus</button>
        `;

        fileUploadArea.appendChild(newInputGroup);

        newInputGroup.querySelector('.remove-file').addEventListener('click', function() {
            newInputGroup.remove();
        });
    });
</script>
<?= $this->endSection() ?>