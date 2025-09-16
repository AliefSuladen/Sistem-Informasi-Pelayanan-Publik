<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">

    </div>
</section>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengajuan Permohonan</h3>

        </div>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-permohonan" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengaju</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($permohonan) && is_array($permohonan)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($permohonan as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['nama_user']) ?></td>
                                    <td><?= esc($item['surat']) ?></td>
                                    <td>
                                        <?= date('d-m-Y', strtotime($item['created_at'])) ?>
                                    </td>
                                    <td><?= esc($item['status']) ?></td>
                                    <td>
                                        <a href="<?= base_url('kades-cek-dokumen/' . $item['id_permohonan']) ?>"
                                            class="btn btn-sm <?= ($item['status'] === 'Diverifikasi Admin Desa') ? 'btn-primary' : 'btn-success' ?>">
                                            Cek Dokumen
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">Tidak ada data pengajuan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tabel-permohonan').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    title: 'Data Laporan Permohonan Surat',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Data Laporan Permohonan Surat',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    title: 'Data Laporan Permohonan Surat',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
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