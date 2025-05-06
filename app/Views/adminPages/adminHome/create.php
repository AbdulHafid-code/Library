<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header ">
        <a href="/admin"><i class="fas fa-arrow-left fa-2x mr-3"></i></a>
        <h1>Halaman Tambah Daftar Buku</h1>
    </div>
</section>

<div class="col-12 col-md-6 col-lg-6">
<div class="card">
    <form action="/admin/store" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
        <div class="card-header">
            <h4>Masukkkan Buku Baru</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control <?= (session('validation') && session('validation')->hasError('judul_buku')) ? 'is-invalid' : '' ?>" value="<?= old('judul_buku'); ?>">
                <?php if (session('validation') && session('validation')->hasError('judul_buku')) : ?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('judul_buku'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="sampul" class="form-label">Sampul</label>
              <input type="file"
                class="form-control <?= (session('validation') && session('validation')->hasError('judul_buku')) ? 'is-invalid' : ''; ?>"
                id="sampul"
                name="sampul">

              <?php if (session('validation') && session('validation')->hasErrors('sampul')) : ?>
                <div class="invalid-feedback">
                  <?php session('validation')->getError('sampul'); ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control <?= (session('validation') && session('validation')->hasError('penulis')) ? 'is-invalid' : '' ?>" value="<?= old('penulis'); ?>">
                <?php if (session('validation') && session('validation')->hasError('penulis')) : ?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('penulis'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" class="form-control <?= (session('validation') && session('validation')->hasError('penerbit')) ? 'is-invalid' : '' ?>" value="<?= old('penerbit'); ?>">
                <?php if (session('validation') && session('validation')->hasError('penerbit')):?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('penerbit'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="date" name="tahun_terbit" class="form-control <?= (session('validation') && session('validation')->hasError('tahun_terbit')) ? 'is-invalid' : '' ?>" value="<?= old('tahun_terbit') ?>">
                <?php if (session('validation') && session('validation')->hasError('tahun_terbit')):?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('tahun_terbit'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori </label>
                <select name="kategori_id" id="kategori_id" class="form-control">
                    <option value="">Kategori</option>
                    <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                    <?php endforeach; ?>
                </select>
                </select>
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" class="form-control <?= (session('validation') && session('validation')->hasError('stok')) ? 'is-invalid' : '' ?>" value="<?= old('stok') ?>">
                <?php if (session('validation') && session('validation')->hasError('stok')):?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('stok'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jumlah_halaman">Jumlah Halaman  </label>
                <input type="number" name="jumlah_halaman" class="form-control <?= (session('validation') && session('validation')->hasError('jumlah_halaman')) ? 'is-invalid' : '' ?>" value="<?= old('jumlah_halaman') ?>">
                <?php if (session('validation') && session('validation')->hasError('jumlah_halaman')):?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('jumlah_halaman'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi')) ? 'is-invalid' : '' ?>" rows="4"><?= old('deskripsi'); ?></textarea>
                <?php if (session('validation') && session('validation')->hasError('penerbit')):?>
                    <div class="invalid-feedback">
                        <?= session('validation')->getError('deskripsi'); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            
        <div class="card-footer text-right">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>