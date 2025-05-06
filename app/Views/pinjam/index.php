<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
</section>


<h2>Pinjam Buku: <?= esc($buku['judul_buku']); ?></h2>
<p>Stok tersedia: <?= $buku['stok'] - $buku['dipinjam']; ?></p>

<form action="/pinjam/proses/<?= $buku['slug'] ?>" method="post">
<?= csrf_field(); ?>
    <label for="jumlah">Jumlah Pinjam:</label>
    <input type="number" name="jumlah" min="1" max="<?= $buku['stok'] - $buku['dipinjam'] ?>" required>
    <button type="submit">Pinjam</button>
</form>



<?= $this->endSection(); ?>