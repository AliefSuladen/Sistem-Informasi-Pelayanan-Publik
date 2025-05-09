<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
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
                html = `<div class="mb-3">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea class="form-control" name="alasan" placeholder="Masukkan alasan pengajuan" required></textarea>
                        </div>`;
                break;
            case '2': // Surat Domisili
                html = `<div class="mb-3">
                            <label for="alamat_domisili" class="form-label">Alamat Domisili</label>
                            <input type="text" class="form-control" name="alamat_domisili"  required>
                        </div>`;
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