<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <h1>Daftar Pengajuan Legalisasi Surat</h1>
    </div>
</section>

<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Pengajuan Legalisasi</h3>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-legalisasi" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengaju</th>
                            <th>Jenis Surat</th>
                            <th>Desa</th>
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
                                    <td><?= esc($item['nama_desa']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                    <td><span class="badge badge-warning"><?= esc($item['status']) ?></span></td>
                                    <td>
                                        <a href="<?= base_url('kecamatan_cek-dokumen/' . $item['id_permohonan']) ?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-file-alt"></i> Cek Dokumen
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada permohonan legalisasi.</td>
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
        $('#tabel-legalisasi').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    title: 'Data Pengajuan Legalisasi'
                },
                {
                    extend: 'pdf',
                    title: 'Data Pengajuan Legalisasi'
                },
                {
                    extend: 'print',
                    title: 'Data Pengajuan Legalisasi'
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