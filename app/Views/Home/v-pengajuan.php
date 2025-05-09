<?= $this->extend('template/temp-frontend') ?>
<?= $this->section('content') ?>

<div class="container">
    <h3 class="mb-4">Form Pengajuan Surat</h3>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('postpengajuan') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" name="nik" pattern="\d{16}" maxlength="16" placeholder="Masukkan 16 digit NIK" required>
        </div>

        <div class="mb-3">
            <label for="nama_user" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_user" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="contoh: user@email.com" required>
        </div>

        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan pekerjaan" required>
        </div>

        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <select class="form-control" name="agama" required>
                <option value="">-- Pilih Agama --</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" name="kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_desa" class="form-label">Desa</label>
            <select class="form-control" name="id_desa" required>
                <option value="">-- Pilih Desa --</option>
                <?php foreach ($desa as $d) : ?>
                    <option value="<?= $d['id_desa']; ?>"><?= $d['nama_desa']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>

        <div class="mb-3">
            <label for="id_jenis" class="form-label">Jenis Surat</label>
            <select class="form-control" name="id_jenis" id="id_jenis" required>
                <option value="">-- Pilih Jenis Surat --</option>
                <?php foreach ($jenis_surat as $jenis) : ?>
                    <option value="<?= $jenis['id_jenis']; ?>"><?= $jenis['surat']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tempat field tambahan -->
        <div id="extra-fields"></div>

        <!-- Input file dokumen pendukung -->
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

<script>
    document.getElementById('id_jenis').addEventListener('change', function() {
        const jenisSurat = this.value;
        const extraFields = document.getElementById('extra-fields');

        // Kosongkan field saat jenis surat berubah
        extraFields.innerHTML = '';

        let html = '';

        switch (jenisSurat) {
            case '1': // Surat Keterangan Tidak Mampu
                html = `<div class="mb-3">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea class="form-control" name="alasan" placeholder="Masukkan alasan pengajuan" required></textarea>
                        </div>
                       <div class="form-group">
                        <label for="status_perkawinan">Status Perkawinan</label>
                        <select name="status_perkawinan" id="status_perkawinan" class="form-control" required>
                            <option value="">-- Pilih Status Perkawinan --</option>
                            <option value="Belum Menikah">Belum Kawin</option>
                            <option value="Menikah">Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                    </div>`;
                break;
            case '2': // Surat Domisili
                html = `<div class="mb-3">
                            <label for="alamat_domisili" class="form-label">Alamat Domisili</label>
                            <input type="text" class="form-control" name="alamat_domisili" placeholder="Masukkan alamat domisili" required>
                        </div>`;
                break;
            case '3': // Surat Kelahiran
                html = `<div class="mb-3">
                            <label for="nama_bayi" class="form-label">Nama Bayi</label>
                            <input type="text" class="form-control" name="nama_anak" placeholder="Masukkan nama bayi" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_bayi" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan nama bayi" required>
                        </div>

                         <div class="mb-3">
                            <label for="nama_bayi" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" placeholder="Masukkan nama bayi" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_bayi" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" placeholder="Masukkan nama bayi" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>`;
                break;
            case '4': // Surat Kematian
                html = `<div class="mb-3">
                            <label for="nama_almarhum" class="form-label">Nama Almarhum</label>
                            <input type="text" class="form-control" name="nama_almarhum" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_wafat" class="form-label">Tanggal Wafat</label>
                            <input type="date" class="form-control" name="tgl_wafat" required>
                        </div>`;
                break;
            case '5': // Surat Pengantar SKCK
                html = `<div class="mb-3">
                            <label for="keperluan" class="form-label">Keperluan</label>
                            <input type="text" class="form-control" name="keperluan" required>
                        </div>`;
                break;
            case '6': // Surat Izin Usaha
            case '7': // Surat Keterangan Usaha
                html = `<div class="mb-3">
                            <label for="nama_usaha" class="form-label">Nama Usaha</label>
                            <input type="text" class="form-control" name="nama_usaha" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                            <input type="text" class="form-control" name="jenis_usaha" required>
                        </div>`;
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