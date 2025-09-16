<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <h4>Edit Berita</h4>
    </div>
</section>

<div class="col-md-12">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('update-berita/' . $berita['id_berita']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Berita</label>
                    <input type="text" id="judul" name="judul" class="form-control"
                        value="<?= esc($berita['judul']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-bold">Isi Berita</label>
                    <textarea id="isi" name="isi" rows="10"><?= esc($berita['isi']) ?></textarea>
                </div>

                <div class="mb-3" id="file-upload-area">
                    <label for="gambar" class="form-label fw-bold">Upload Gambar Berita</label>

                    <?php
                    $images = !empty($berita['gambar']) ? json_decode($berita['gambar'], true) : [];
                    if (!empty($images)):
                        foreach ($images as $img):
                    ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/berita/' . $img) ?>" alt="Gambar" style="max-width:120px;">
                            </div>
                    <?php endforeach;
                    endif; ?>

                    <div class="input-group mb-2">
                        <input type="file" class="form-control" name="gambar[]" accept="image/*" multiple onchange="updateFileName(this)">
                        <button type="button" class="btn btn-success" id="add-file">Tambah File</button>
                    </div>
                    <small class="text-muted" id="file-name"></small>
                </div>

                <button type="submit" class="btn btn-primary mt-2">
                    <i class="fas fa-save me-1"></i> Update Berita
                </button>
                <a href="<?= base_url('data-berita') ?>" class="btn btn-secondary mt-2">Batal</a>
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

    function updateFileName(input) {
        if (input.files.length > 0) {
            let fileNames = Array.from(input.files).map(f => f.name).join(", ");
            document.getElementById('file-name').textContent = "File terpilih: " + fileNames;
        } else {
            document.getElementById('file-name').textContent = "";
        }
    }

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