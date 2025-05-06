<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Hasil Pencarian Anda...</h1>
    </div>
</section>

<div class="row">
    <?php foreach ($buku as $br):?>
    <div class="col-12 col-md-3 col-lg-3 mb-3">
        <div class="card card-warning h-100">
            <div class="card-header " >
                <a href="/detail/<?= $br['slug'] ?>" class="btn">
                    <img src="/sampul/<?= $br['sampul'] ?>" 
                        class="img-fluid" 
                        style="height: 250px; object-fit: cover; width: 100%;" 
                        alt="<?= esc($br['judul_buku']) ?>">
                </a>
            </div>
            <div class="card-body">
            <h4 class="font-weight-bold" style="line-height: 1;"><?= $br['judul_buku']; ?></h4>
            <p class="small" style="line-height: 1.2;"><?= character_limiter(strip_tags($br['deskripsi']), 50) ?></p>
            <div class="row-12">
                <h5 class="small text-info font-weight-bold">Stok: <?= $br['stok_tersedia'] ?> </h5>

                    <?php 
                    $rating = floor($br['avg_rating']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<span style="color: gold; font-size: 1.2rem;">★</span>';
                        } else {
                            echo '<span style="color: lightgray; font-size: 1.2rem;">★</span>';
                        }
                    }
                    ?>
                    (<?= number_format($br['avg_rating'], 1) ?>)

            </div>

            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>


<?= $this->endSection(); ?>


