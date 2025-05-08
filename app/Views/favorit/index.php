<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Favorit</h1>
    </div>
</section>


<!-- buku faforit -->
<div class="row">
    <div class="card ml-3 mr-3 w-100">
        <div class="card-body ">
            <ul class="list-unstyled list-unstyled-border">
                <?php foreach ($myFavorit as $b) :?>
                    <li class="media">
                        <a href="/detail/<?= $b['slug'] ?>">
                            <img class="mr-3 rounded" width="70" src="sampul/<?= $b['sampul'] ?>" alt="product">
                        </a>
                        <div class="media-body">
                            <div class="media-title font-weight-bold" style="font-size:30px;"><?= $b['judul_buku'] ?></div>

                            <style>
                                .favorit {
                                    font-size: 30px !important;
                                }   
                                input[type="radio"] {
                                    display: none;
                                }
                            </style>

                            <form action="/favorit/hapus/<?= $b['id_buku'] ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE"> <!-- Untuk metode delete -->
                                <label for="unfavorit<?= $b['id_buku'] ?>">
                                    <i class="fas fa-heart favorit" style="color: red;"></i>
                                </label>
                                <input type="radio" id="unfavorit<?= $b['id_buku'] ?>" name="unfavorit_<?= $b['id_buku'] ?>" onclick="this.form.submit()">
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>