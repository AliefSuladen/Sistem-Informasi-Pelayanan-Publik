<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <h4 class="mb-2">Laporan Permohonan Surat - <?= esc($desa['nama_desa']) ?></h4>
    </div>
</section>

<div class="col-md-12">
    <!-- Filter -->
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form method="get" action="">
                <div class="form-row align-items-end">
                    <div class="form-group col-md-4">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">-- Pilih Tahun --</option>
                            <?php for ($y = 2023; $y <= date('Y'); $y++): ?>
                                <option value="<?= $y ?>" <?= ($tahun == $y) ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">-- Pilih Bulan --</option>
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?= $m ?>" <?= ($bulan == $m) ? 'selected' : '' ?>>
                                    <?= date('F', mktime(0, 0, 0, $m, 10)) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-filter"></i> Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Data Laporan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-laporan" class="table table-striped table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengaju</th>
                            <th>Jenis Surat</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>File Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($permohonan)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($permohonan as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['nama_user']) ?></td>
                                    <td><?= esc($item['surat']) ?></td>
                                    <td><?= esc($item['nomor_surat']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                    <td><?= esc($item['status']) ?></td>
                                    <td>
                                        <a href="<?= base_url('uploads/dokumen/' . $item['file_surat']) ?>" target="_blank" class="btn btn-sm btn-info">Lihat PDF</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data untuk ditampilkan.</td>
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
        $('#tabel-laporan').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: ['excel', 'pdf', 'print'],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>