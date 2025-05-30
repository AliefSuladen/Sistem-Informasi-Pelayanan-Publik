<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">

    </div>
</section>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Warga Desa <?= esc($nama_desa) ?></h3>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-warga" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($warga) && is_array($warga)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($warga as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['nik']) ?></td>
                                    <td><?= esc($item['nama_user']) ?></td>
                                    <td><?= esc($item['kelamin']) ?></td>
                                    <td><?= esc($item['agama']) ?></td>
                                    <td><?= esc($item['pekerjaan']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">Tidak ada data warga.</td>
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
        $('#tabel-warga').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    title: 'Data Warga Desa',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Data Warga Desa',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]

                    }
                },
                {
                    extend: 'print',
                    title: 'Data Warga Desa',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]

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