<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">

    </div>
</section>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Berita Website</h3>
            <a href="<?= base_url('create-berita') ?>" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-plus"></i> Tambah Berita
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-berita" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Berita</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($berita) && is_array($berita)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($berita as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($item['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('edit-berita/' . $item['id_berita']) ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="<?= base_url('delete-berita/' . $item['id_berita']) ?>" method="post" style="display:inline-block;" onsubmit="return confirm('Apakah anda yakin ingin menghapus berita ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada berita.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tabel-berita').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    title: 'Daftar Berita',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Daftar Berita',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'print',
                    title: 'Daftar Berita',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>