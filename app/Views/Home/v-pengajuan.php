<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>

<div class="container py-4">
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
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" maxlength="16" pattern="\d{16}" placeholder="Masukkan 16 digit NIK" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nama_user" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_user" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="contoh: user@email.com" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan pekerjaan" required>
                    </div>

                    <div class="col-md-6 mb-3">
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

                    <div class="col-md-6 mb-3">
                        <label for="kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="kelamin" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="id_desa" class="form-label">Desa</label>
                        <select class="form-control" name="id_desa" required>
                            <option value="">-- Pilih Desa --</option>
                            <?php foreach ($desa as $d): ?>
                                <option value="<?= $d['id_desa'] ?>"><?= $d['nama_desa'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="id_jenis" class="form-label">Jenis Surat</label>
                        <select class="form-control" name="id_jenis" id="id_jenis" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            <?php foreach ($jenis_surat as $jenis): ?>
                                <option value="<?= $jenis['id_jenis'] ?>"><?= $jenis['surat'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Tambahan berdasarkan jenis surat -->
                <div id="extra-fields"></div>

                <!-- Upload Dokumen -->
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

<!-- JavaScript -->
<script>
    document.getElementById('id_jenis').addEventListener('change', function() {
        const jenisSurat = this.value;
        const extraFields = document.getElementById('extra-fields');
        extraFields.innerHTML = '';

        let html = '';

        switch (jenisSurat) {
            case '1':
                html = `
                    <div class="mb-3">
                        <label class="form-label">Alasan</label>
                        <textarea class="form-control" name="alasan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Perkawinan</label>
                        <select name="status_perkawinan" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option>Belum Kawin</option>
                            <option>Kawin</option>
                            <option>Cerai Hidup</option>
                            <option>Cerai Mati</option>
                        </select>
                    </div>`;
                break;
            case '2':
                html = `
                    <div class="mb-3">
                        <label class="form-label">Alamat Domisili</label>
                        <input type="text" class="form-control" name="alamat_domisili" required>
                    </div>`;
                break;
            case '3':
                html = `
                    <div class="mb-3">
                        <label class="form-label">Nama Bayi</label>
                        <input type="text" class="form-control" name="nama_anak" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control" name="nama_ayah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                    </div>`;
                break;
            case '4':
                html = `
                    <div class="mb-3">
                        <label class="form-label">Nama Almarhum</label>
                        <input type="text" class="form-control" name="nama_almarhum" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Wafat</label>
                        <input type="date" class="form-control" name="tgl_wafat" required>
                    </div>`;
                break;
            case '5':
                html = `
                    <div class="mb-3">
                        <label class="form-label">Keperluan</label>
                        <input type="text" class="form-control" name="keperluan" required>
                    </div>`;
                break;
            case '6':
            case '7':
                html = `
                    <div class="mb-3">
                        <label class="form-label">Nama Usaha</label>
                        <input type="text" class="form-control" name="nama_usaha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Usaha</label>
                        <input type="text" class="form-control" name="jenis_usaha" required>
                    </div>`;
                break;
        }

        extraFields.innerHTML = html;
    });

    function updateFileName(input) {
        const label = document.getElementById('file-name');
        if (input.files.length > 0) {
            label.textContent = `File terpilih: ${input.files[0].name}`;
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