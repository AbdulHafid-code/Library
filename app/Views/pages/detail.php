
<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header d-flex align-items-center mb-4">
        <a href="/" class="btn btn-primary mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="h4 mb-0 font-weight-bold">Detail Buku</h1>
    </div>
</section>



<div class="card p-5" style="height: 100vh;">
    <div class="row">
        <div class="col-md-4">
            <img src="/sampul/<?= $buku['sampul'] ?>"
                class="img-fluid h-100 mb-3" 
                style="object-fit: cover;" 
                alt="<?= esc($buku['judul_buku']) ?>">

            <a href="/pinjam/<?= $buku['slug'] ?>" class="btn btn-primary btn-block">
                <i class="fas fa-bookmark"></i> Pinjam
            </a>
        </div>

        <div class="col-md-8">
        <div class="card-body">
            <h2 class="card-title bold text-body"><?= $buku['judul_buku'] ?></h2>
            <h6 class="card-title bold text-body"><?= $buku['slug'] ?></h6>
            <p class="card-text"><?= $buku['deskripsi'] ?></p>
        </div>

        <div class="card-body">
            <h6>Penulis: <span class="text-body"><?= $buku['penulis'] ?></span></h6>
            <h6>Penerbit: <span class="text-body"><?= $buku['penerbit'] ?></span></h6>
            <h6>Tahun Terbit: <span class="text-body"><?= $buku['tahun_terbit'] ?></span></h6>
            <h6>Kategori: <span class="text-body"><?= $buku['nama_kategori'] ?></span></h6>
            <h6>Stok: <span class="text-body"><?= $buku['stok'] ?></span></h6>
            <h6>Jumlah Halaman: <span class="text-body"><?= $buku['jumlah_halaman'] ?></span></h6>
        </div>



        <style>
            .star-rating input {
                display: none;
            }

            .star-rating label {
                font-size: 30px;
                color: black; /* Bintang default berwarna hitam */
                cursor: pointer;
            }

            .star-rating label.filled {
                color: yellow; /* Bintang yang dipilih berwarna kuning */
            }

            .star-rating input:checked ~ label {
                color: yellow; /* Jika input terpilih, bintang yang sesuai menjadi kuning */
            }

            .star-rating {
                direction: rtl;
                font-size: 2rem;
                unicode-bidi: bidi-override;
                display: inline-flex;
            }

            .star-rating input[type="radio"] {
                display: none;
            }

            .star-rating label {
                color: transparent;
                cursor: pointer;
                position: relative;
            }

            .star-rating label::before {
                content: "★";
                position: absolute;
                left: 0;
                color: transparent;
                -webkit-text-stroke: 1px black; /* border hitam */
            }

            /* Saat bintang dipilih (checked) */
            .star-rating input[type="radio"]:checked ~ label::before,
            .star-rating label:hover::before,
            .star-rating label:hover ~ label::before {
                color: gold;
                -webkit-text-stroke: 0;
            }
            
        </style>

        <form action="/rating/<?= $buku['id_buku'] ?>" method="post">
            <?= csrf_field(); ?>
            <div class="star-rating">
                <?php if (empty($ratingUser)): ?>
                    <!-- Jika rating belum ada, tampilkan bintang kosong -->
                    <input type="radio" id="star5" name="rating" value="5" onclick="this.form.submit()">
                    <label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4" onclick="this.form.submit()">
                    <label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3" onclick="this.form.submit()">
                    <label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2" onclick="this.form.submit()">
                    <label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1" onclick="this.form.submit()">
                    <label for="star1">★</label>      
                    <!-- <button type="submit" class="btn btn-primary mt-2">Kirim Rating</button> -->
                <?php else: ?>
                    <!-- Jika rating sudah ada, tampilkan rating yang sudah diberikan -->
                    <?php for ($i = 5; $i >= 1; $i--) : ?>
                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" 
                            <?= ($ratingUser == $i) ? 'checked' : '' ?> 
                            onclick="this.form.submit()">
                        <label for="star<?= $i ?>" class="<?= ($ratingUser >= $i) ? 'filled' : 'empty' ?>">★</label>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </form>
        </div>
 
    </div>
</div>








<?= $this->endSection(); ?>