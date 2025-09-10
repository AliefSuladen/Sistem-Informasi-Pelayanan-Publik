<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <h4>Ajukan Permohonan Surat</h4>
    </div>
</section>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('masyarakat-simpan-legalisasi') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <input type="hidden" name="id_permohonan" value="<?= $permohonan['id_permohonan'] ?>">

                <h5>Preview Dokumen Pendukung Lama:</h5>
                <?php if (!empty($dokumenPendukung)): ?>
                    <div class="row">
                        <?php foreach ($dokumenPendukung as $dok): ?>
                            <div class="col-md-3 mb-3 text-center">
                                <?php $filePath = base_url('uploads/dokumen/' . $dok['file_dokumen']); ?>
                                <a href="<?= $filePath ?>" target="_blank">
                                    <img src="<?= $filePath ?>" class="img-fluid img-thumbnail" style="max-width:200px;">
                                </a>
                                <p class="mt-1"><?= esc($dok['nama_dokumen']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Tidak ada dokumen pendukung.</p>
                <?php endif; ?>

                <hr>
                <div class="mb-3" id="file-upload-area">
                    <label for="dokumen" class="form-label">Upload Dokumen Tambahan</label>
                    <ul>
                        <li>Photo copy KTP dan KK 1 lembar</li>
                        <li>Bukti lunas PBB</li>
                    </ul>

                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="dokumen[]" accept="image/*" multiple onchange="updateFileName(this)">
                        <button type="button" class="btn btn-success" id="add-file">Tambah File</button>
                    </div>
                    <small class="text-muted" id="file-name"></small>
                </div>

                <button type="submit" class="btn btn-primary mt-2">
                    <i class="fas fa-file-signature"></i> Ajukan Legalisasi Camat
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Update nama file yang dipilih
    function updateFileName(input) {
        if (input.files.length > 0) {
            let fileNames = Array.from(input.files).map(f => f.name).join(", ");
            document.getElementById('file-name').textContent = "File terpilih: " + fileNames;
        } else {
            document.getElementById('file-name').textContent = "";
        }
    }

    // Tambah input file baru
    document.getElementById('add-file').addEventListener('click', function() {
        const fileUploadArea = document.getElementById('file-upload-area');
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('input-group', 'mb-2');

        newInputGroup.innerHTML = `
            <input type="file" class="form-control" name="dokumen[]" accept="image/*" multiple onchange="updateFileName(this)">
            <button type="button" class="btn btn-danger remove-file">Hapus</button>
        `;
        fileUploadArea.appendChild(newInputGroup);

        newInputGroup.querySelector('.remove-file').addEventListener('click', function() {
            newInputGroup.remove();
        });
    });
</script>

<?= $this->endSection() ?>