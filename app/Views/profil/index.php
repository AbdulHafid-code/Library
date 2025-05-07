<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <a href="/" class="btn btn-primary mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1>Profil</h1>
    </div>
</section>

<div class="section-body">
<h2 class="section-title">Hi, <?= $user['nama_user'] ?></h2>

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
    <div class="card profile-widget">
        <div class="profile-widget-header">                     
        <img alt="image" src="/foto_siswa/<?= $user['foto_siswa'] ?>" class="rounded-circle profile-widget-picture">
        <div class="profile-widget-items">
            <div class="profile-widget-item">
            <div class="profile-widget-item-label"></div>
            <div class="profile-widget-item-value"></div>
            </div>
            <div class="profile-widget-item">
            <div class="profile-widget-item-label"></div>
            <div class="profile-widget-item-value"></div>
            </div>
            <div class="profile-widget-item">
            <div class="profile-widget-item-label"></div>
            <div class="profile-widget-item-value"></div>
            </div>
        </div>
        </div>
        <div class="profile-widget-description">
        <div class="profile-widget-name"><?= $user['nama_user'] ?><div class="text-muted d-inline font-weight-normal"><div class="slash"></div><?= $user['kelas'] ?></div></div>
        <?= $user['deskripsi'] ?>
        </div>
        <div class="card-footer text-center">
        <a href="#" class="btn btn-social-icon btn-facebook mr-1">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="btn btn-social-icon btn-twitter mr-1">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="btn btn-social-icon btn-github mr-1">
            <i class="fab fa-github"></i>
        </a>
        <a href="#" class="btn btn-social-icon btn-instagram">
            <i class="fab fa-instagram"></i>
        </a>
        </div>
    </div>
    </div>

    <!-- Profile -->
    <div class="col-12 col-md-12 col-lg-7">
    <div class="card">
        <form method="post" class="needs-validation" novalidate="" action="/profil/saveData/<?= $user['id_user'] ?>">
        <?= csrf_field() ?>
        <div class="card-header">
            <h4>Edit Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">                               
                <div class="form-group col-md-6 col-12">
                <label>Name</label>
                <input type="text" name="nama_user" class="form-control" value="<?= $user['nama_user'] ?>" required="">
                <div class="invalid-feedback">
                    Please fill in the first name
                </div>
                </div>
                <div class="form-group col-md-6 col-12">
                <label>Kelas</label>
                <input type="text" class="form-control" value="<?= $user['kelas'] ?>" required="">
                <div class="invalid-feedback">
                    Please fill in the last name
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-7 col-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required="">
                <div class="invalid-feedback">
                    Please fill in the email
                </div>
                </div>
                <div class="form-group col-md-5 col-12">
                <label>No Hp</label>
                <input type="tel" name="NoHp" class="form-control" value="<?= $user['NoHp'] ?>">
                </div>
                <div class="form-group col-md-7 col-12">
                    <label for="exampleFormControlFile1">Example file input</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" value="<?= $user['foto_siswa'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                <label>Bio</label>
                <textarea name="deskripsi" class="form-control summernote-simple"><?= $user['deskripsi'] ?></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary">Save Changes</button>
        </div>
        </form>
    </div>
    </div>
</div>
</div>



<?php if (session()->get('email') !== 'redmatrixsaga@gmail.com') :?>
<h3>Daftar Peminjaman / RIWAYAT</h3>
<table class="table">
    <thead>
        <tr>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Persetujuan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($peminjaman as $p): ?>
            <tr>
                <td><?= esc($p['judul_buku']) ?></td>
                <td><?= $p['tanggal_pinjam'] ?></td>
                
                <td>
                    <?php if ($p['tanggal_kembali'] < date('Y-m-d H:i:s')):?>
                        <span class="badge bg-danger text-dark">Waktunya Untuk Mengembalikan</span>
                    <?php else:?>
                        <?= $p['tanggal_kembali'] ?>
                    <?php endif?>
                </td>

                <td><?= $p['status'] ?></td>
                <td>
                    <?php if ($p['disetujui'] === 'pending'): ?>
                        <span class="badge bg-warning">Menunggu</span>
                    <?php elseif ($p['disetujui'] === 'diterima'): ?>
                        <span class="badge bg-success">Diterima</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Ditolak</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>



<?= $this->endSection(); ?>