<?= $this->extend('template/temp-backend') ?>
<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Profil Saya</h1>
            </div>
        </div>
    </div>
</section>

<div class="col-md-12">
    <div class="card">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>


        <div class="card-header">
            <h3 class="card-title">Ubah Profil</h3>
        </div>
        <form action="<?= base_url('update-profil') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="numeric" name="nik" value="<?= esc($user['nik']) ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_user" value="<?= esc($user['nama_user']) ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="<?= esc($user['pekerjaan']) ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option value="">-- Pilih --</option>
                                <?php
                                $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'];
                                foreach ($agamaList as $agama) {
                                    $selected = $user['agama'] == $agama ? 'selected' : '';
                                    echo "<option value='$agama' $selected>$agama</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password Baru (kosongkan jika tidak diganti)</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?= esc($user['alamat']) ?>" class="form-control">
                </div>





                <div class="form-group">
                    <label>Foto Profil</label><br>
                    <input type="file" name="foto" class="form-control-file mb-2">
                    <?php if (!empty($user['foto'])) : ?>
                        <img src="<?= base_url('uploads/profil/' . $user['foto']) ?>" alt="Foto Profil" width="120" class="img-thumbnail mt-2">
                    <?php else : ?>
                        <p class="text-muted">Belum ada foto profil.</p>
                    <?php endif; ?>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>