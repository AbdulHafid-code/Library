<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Buku Is The Book</h1>
    </div>
</section>


<form action="/" method="get">
    <select name="id_kategori" id="id_kategori" onchange="this.form.submit()">
        <option value="">Semua Kategory</option>
        <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>" <?= ($id_kategori == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
    </select>
</form>


<div class="row ">
<?php if (count($buku) > 0): ?>
    <?php foreach ($buku as $b):?>
    <div class="col-12 col-md-3 col-lg-3 mb-3">
        <div class="card card-warning h-100">
            <div class="card-header " >
                <img src="/sampul/<?= $b['sampul'] ?>" 
                    class="img-fluid" 
                    style="height: 250px; object-fit: cover; width: 100%;" 
                    alt="<?= esc($b['judul_buku']) ?>">
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold" style="line-height: 1;"><?= $b['judul_buku']; ?></h4>
                <p class="small" style="line-height: 1.2;"><?= character_limiter(strip_tags($b['deskripsi']), 50) ?></p>
                <div class="row-12">
                    <h5 class="small text-info font-weight-bold">Stok: <?= $b['stok'] ?> </h5>
                    <h5 class="small text-warning font-weight-bold">Rating</h5>

                    <a href="/detail/<?= $b['slug'] ?>" class="btn btn-success">Detail</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>
</div>

<?= $this->endSection(); ?>


