<?= $this->extend('template/temp-backend') ?>

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <h1>Log Aktivitas</h1>
    </div>
</section>

<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Daftar Log Aktivitas</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-log" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Aksi</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs) && is_array($logs)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($logs as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama_user'] ?? '-') ?></td>
                                    <td><?= esc($row['activity'] ?? $row['aksi'] ?? '-') ?></td>
                                    <td><?= esc($row['ip_address'] ?? '-') ?></td>
                                    <td><small><?= esc($row['user_agent'] ?? '-') ?></small></td>
                                    <td><?= date('d-m-Y H:i:s', strtotime($row['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada log aktivitas.</td>
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
        $('#tabel-log').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    title: 'Log Aktivitas'
                },
                {
                    extend: 'pdf',
                    title: 'Log Aktivitas'
                },
                {
                    extend: 'print',
                    title: 'Log Aktivitas'
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