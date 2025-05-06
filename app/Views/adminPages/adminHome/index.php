<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Admin</h1>
    </div>
</section>

<div class="row">
    <div class="col-lg-12 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <a href="/admin/create">
                <div class="card-icon bg-primary">
                    <i class="fas fa-book"></i>
                </div>
            </a>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Tambah Buku</h4>
                </div>
                <div class="card-body">
                    <?= $totalBuku ?>
                </div>
            </div>
        </div>

        <!-- Pesan Jika Berhasil -->
        <?php if (session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif;?>

        <div class="card">
            <div class="card-header">
            <h4>Daftar Buku </h4>
            </div>
            <div class="card-body table-responsive">
            <table class="table table-striped" >
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Jumlah Halaman</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($buku as $b):?>
 
                        <tr>
                            <th><?= $no++ ?></th>
                            <td><?= $b['judul_buku'] ?></td>
                            <td><?= $b['slug'] ?></td>
                            <td><img src="/sampul/<?= $b['sampul'] ?>" width="70" alt=""></td>
                            <td><?= $b['penulis'] ?></td>
                            <td><?= $b['penerbit'] ?></td>
                            <td><?= $b['stok'] ?></td>
                            <td><?= $b['jumlah_halaman'] ?></td>
                            <td><?= $b['deskripsi'] ?></td>

                            <td>
                                <a href="/admin/edit/<?= $b['slug'] ?>" class="btn btn-primary">Edit</a> 

                                <form action="/admin/<?= $b['id_buku'] ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Mau dahapus dek') ">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            
        </div>
    </div>                 
</div>






<?= $this->endSection(); ?>