
<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <a href="/admin/peminjaman"><==</a><h1>Riwayat</h1>
    </div>
</section>



<h3>Daftar Riwayat</h3>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Jumlah</th>
            <th>Persetujuan</th>
            <th>aksi</th>
        </tr>
    </thead>


    <?php foreach ($pinjam as $p) : ?>
        <tbody>
            <tr>
                <td><?= esc($p['nama_user']) ?></td>
                <td><?= esc($p['judul_buku']) ?></td>
                <td><?= esc($p['tanggal_pinjam']) ?></td>
                <td><?= esc($p['tanggal_kembali']) ?></td>
                <td><?= esc($p['jumlah']) ?></td>
                <td>
                    
                    <span class=" border px-2 py-1 rounded <?= $p['disetujui'] === 'diterima' ? 'text-success border-success' : ($p['disetujui'] === 'ditolak' ? 'text-danger border-success' : 'text-inherit') ?> font-weight-bold">
                    <?= $p['disetujui'] ?>
                    </span>
                </td>
                <td>
                    <form action="<?= base_url('admin/peminjaman/' . $p['id_peminjam']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method">
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </form>
                </td>
            </tr>
        </tbody>
    <?php endforeach;?>
</table>





<?= $this->endSection(); ?>