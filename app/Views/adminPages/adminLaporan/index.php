<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Laporan Bulanan</h1>
    </div>
</section>


<div class="container mt-4">
    <h2 class="mb-4">Laporan Bulanan</h2>

    <form method="get" class="form-inline mb-4">
        <label class="mr-2" for="bulan">Bulan:</label>
        <select name="bulan" id="bulan" class="form-control mr-2">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>" <?= ($bulan == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : ''; ?>>
                    <?= date('F', mktime(0, 0, 0, $i, 1)); ?>
                </option>
            <?php endfor; ?>
        </select>

        <label class="mr-2" for="tahun">Tahun:</label>
        <input type="number" name="tahun" id="tahun" class="form-control mr-2" value="<?= $tahun ?>">

        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <div class="card">
        <div class="card-body">
            <p><strong>Bulan:</strong> <?= date('F', mktime(0, 0, 0, $bulan, 1)); ?> - <strong>Tahun:</strong> <?= $tahun ?></p>
            <p><strong>Jumlah Buku Dipinjam:</strong> <?= count($jumlahDipinjam) ?></p>
            <p><strong>Jumlah Buku Dikembalikan:</strong> <?= count($jumlahDikembalikan) ?></p>
            <p><strong>Buku Paling Populer:</strong> <?= $bukuPopuler['judul'] ?? '-' ?></p>
        </div>
    </div>

    <div class="mt-4">
        <a href="#" class="btn btn-danger" onclick="window.print()">Print</a>
        <a href="<?= base_url('admin/laporan/exportpdf?bulan=' . $bulan . '&tahun=' . $tahun) ?>" class="btn btn-secondary">Export PDF</a>
    </div>
</div>

<a href="/laporan/cetak?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" target="_blank">Cetak / PDF</a>







<?= $this->endSection(); ?>