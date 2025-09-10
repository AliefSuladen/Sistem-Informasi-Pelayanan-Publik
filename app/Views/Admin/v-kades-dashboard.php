<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <h1>Dashboard Desa <?= esc($desa['nama_desa']) ?></h1>
    </div>
</section>

<div class="col-md-12">
    <div class="row">
        <?php
        $statusLabels = [
            'Pending' => 'warning',
            'Diverifikasi Pihak Desa' => 'info',
            'Selesai' => 'success',
            'Ditolak' => 'danger'
        ];
        ?>

        <?php foreach ($statistik as $item): ?>
            <div class="col-md-3">
                <div class="small-box bg-<?= $statusLabels[$item['status']] ?? 'secondary' ?>">
                    <div class="inner">
                        <h3><?= $item['jumlah'] ?></h3>
                        <p><?= $item['status'] ?></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Grafik Status & Jenis Surat -->
    <div class="row">
        <!-- Grafik Permohonan per Status -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Grafik Permohonan per Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartPermohonanStatus" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Jenis Surat Terbanyak -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Grafik Jenis Surat Terbanyak</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartJenisSurat" style="max-height: 400px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Grafik batang status permohonan
    const ctxStatus = document.getElementById('chartPermohonanStatus').getContext('2d');
    new Chart(ctxStatus, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($statistik, 'status')) ?>,
            datasets: [{
                label: 'Jumlah Permohonan',
                data: <?= json_encode(array_column($statistik, 'jumlah')) ?>,
                backgroundColor: ['#f39c12', '#17a2b8', '#28a745', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik lingkaran jenis surat
    const ctxSurat = document.getElementById('chartJenisSurat').getContext('2d');
    new Chart(ctxSurat, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($jenisSurat, 'surat')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($jenisSurat, 'total')) ?>,
                backgroundColor: [
                    '#007bff', '#28a745', '#dc3545', '#ffc107', '#6610f2', '#fd7e14', '#20c997'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>