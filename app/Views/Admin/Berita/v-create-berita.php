<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <h4>Tambah Berita Baru</h4>
    </div>
</section>

<div class="col-md-12">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('post-berita') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Berita</label>
                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul berita" required>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-bold">Isi Berita</label>
                    <textarea id="isi" name="isi" rows="10" placeholder="Masukkan isi berita"></textarea>
                </div>

                <div class="mb-3" id="file-upload-area">
                    <label for="gambar" class="form-label fw-bold">Upload Gambar Berita</label>
                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="gambar[]" accept="image/*" multiple onchange="updateFileName(this)">
                        <button type="button" class="btn btn-success" id="add-file">Tambah File</button>
                    </div>
                    <small class="text-muted" id="file-name"></small>
                </div>

                <button type="submit" class="btn btn-primary mt-2">
                    <i class="fas fa-save me-1"></i> Simpan Berita
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#isi'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', 'strikethrough', 'link',
                    '|', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable',
                    '|', 'undo', 'redo', 'alignment', 'fontColor', 'fontBackgroundColor'
                ]
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
            },
            licenseKey: '',
        })
        .catch(error => {
            console.error(error);
        });

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
            <input type="file" class="form-control" name="gambar[]" accept="image/*" multiple onchange="updateFileName(this)">
            <button type="button" class="btn btn-danger remove-file">Hapus</button>
        `;
        fileUploadArea.appendChild(newInputGroup);

        newInputGroup.querySelector('.remove-file').addEventListener('click', function() {
            newInputGroup.remove();
        });
    });
</script>

<?= $this->endSection() ?>