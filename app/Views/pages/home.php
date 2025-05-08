<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
</section>

<style>
    .favorit {
        font-size: 30px !important;
    }   
    input[type="radio"] {
        display: none;
    }
</style>

<div class="row">
    <?php foreach (array_slice($bukuRandom, 0, 8) as $br): ?>
    <div class="col-12 col-md-3 col-lg-3 mb-3">
        <div class="card card-warning h-100">
            <div class="card-header text-center">
                <a href="/detail/<?= $br['slug'] ?>" class="btn">
                    <img src="/sampul/<?= $br['sampul'] ?>" 
                         class="img-fluid mx-auto d-block" 
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
                
                <?php if (empty($br['favoritUser'])): ?>
                    <form action="/favorit/<?= $br['id_buku'] ?>" method="post">
                        <?= csrf_field() ?>
                        <label for="favorit<?= $br['id_buku'] ?>">
                            <i class="far fa-heart favorit"></i> <!-- class dipindah ke <i> -->
                        </label>  
                        <input type="radio" id="favorit<?= $br['id_buku'] ?>" name="favorit_<?= $br['id_buku'] ?>" onclick="this.form.submit()"> 
                       </form>
                    <p><?= $br['total_favorit'] ?></p>
                <?php else: ?>
                    <form action="/favorit/hapus/<?= $br['id_buku'] ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE"> <!-- Untuk metode delete -->
                        <label for="unfavorit<?= $br['id_buku'] ?>">
                            <i class="fas fa-heart favorit" style="color: red;"></i>
                        </label>
                        <input type="radio" id="unfavorit<?= $br['id_buku'] ?>" name="unfavorit_<?= $br['id_buku'] ?>" onclick="this.form.submit()">
                    </form>
                    <p><?= $br['total_favorit'] ?></p>
                <?php endif;?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>



<!-- buku terbaru -->
<div class="row">
    <section class="section mt-5 ml-5 mr-5 w-100" >
        <div class="section-header">
            <h1>Buku Terbaru</h1>
        </div>
    </section>

    <div class="card ml-3 mr-3 w-100">
        <div class="card-body ">
            <ul class="list-unstyled list-unstyled-border">
                <?php foreach (array_slice($buku,0,5) as $b) :?>
                    <li class="media">
                        <a href="/detail/<?= $b['slug'] ?>">
                            <img class="mr-3 rounded" width="70" src="sampul/<?= $b['sampul'] ?>" alt="product">
                        </a>
                        <div class="media-body">
                            <div class="media-title font-weight-bold" style="font-size:30px;"><?= $b['judul_buku'] ?></div>
                            <div class="text-muted text-small">by <a href="#"><?= $b['penulis'] ?></a> <div class="bullet"></div> <?= $b['created_at'] ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<!-- buku Populer -->
<div class="row">
    <section class="section mt-5 ml-5 mr-5 w-100" >
        <div class="section-header">
            <h1>Buku Populer</h1>
        </div>
    </section>

    <div class="card ml-3 mr-3 w-100">
        <div class="card-body ">
            <ul class="list-unstyled list-unstyled-border">
                <?php foreach ($populer as $p) :?>
                    <li class="media">
                        <a href="/detail/<?= $p['slug'] ?>">
                            <img class="mr-3 rounded" width="70" src="sampul/<?= $p['sampul'] ?>" alt="product">
                        </a>
                        <div class="media-body">
                            <div class="media-title font-weight-bold" style="font-size:30px;"><?= $p['judul_buku'] ?></div>
                            <div class="text-muted text-small">by <a href="#"><?= $p['penulis'] ?></a> <div class="bullet"></div> <?= $p['created_at'] ?></div>
                        </div>
                    </li>
                    <li>
                        <?php if (empty($p['favoritUser'])) :?>
                            <form action="/favorit/<?= $p['id_buku'] ?>" method="post">
                                <?= csrf_field() ?>
                                <label for="favorit<?= $p['id_buku'] ?>">
                                    <i class="far fa-heart favorit"></i> <!-- class dipindah ke <i> -->
                                </label>
                                <input type="radio" name="favorit<?= $p['id_buku'] ?>" id="favorit<?= $p['id_buku'] ?>" onclick="this.form.submit()">
                            </form>
                        <?php else:?>
                            <form action="/favorit/hapus/<?= $p['id_buku'] ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <label for="unfollow<?= $p['id_buku'] ?>">
                                    <i class="fas fa-heart favorit" style="color: red;"></i>
                                </label>
                                <input type="radio" name="unfavorit<?= $p['id_buku'] ?>" id="unfavorit<?= $p['id_buku'] ?>" onclick="this.form.submit()">
                            </form>
                        <?php endif;?>
                        <p><?= $p['total_favorit'] ?></p>

                        <?php 
                        $rating = floor($p['avg_rating']);
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '<span style="color: gold; font-size: 1.2rem;">★</span>';
                            } else {
                                echo '<span style="color: lightgray; font-size: 1.2rem;">★</span>';
                            }
                        }
                        ?>
                        (<?= number_format($p['avg_rating'], 1) ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<div class="row">
    <section class="section mt-5 ml-5 mr-5 w-100" >
        <div class="section-header">
            <h1>Kategori </h1>
        </div>
        
        <div>
            <?php foreach ($kategori as $k):?>
                <a href="/kategori/<?= $k['nama_kategori'] ?>" class="btn btn-primary"><?= $k['nama_kategori'] ?></a>
            <?php endforeach; ?>
        </div>
        
    </section>
</div>





<?= $this->endSection(); ?>


