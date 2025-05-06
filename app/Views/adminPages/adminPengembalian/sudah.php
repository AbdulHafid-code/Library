
<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <a href="/admin/pengembalian"><==</a><h1>Sudah Dikembalikan</h1>
    </div>
</section>



<h3>Daftar Buku Yang Sudah dikembalikan</h3>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Buku</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>


    <?php foreach ($pinjam as $p) : ?>
        <tbody>
            <tr>
                <td><?= esc($p['nama_user']) ?></td>
                <td><?= esc($p['judul_buku']) ?></td>
                <td><?= esc($p['jumlah']) ?></td>
                <td> 
                    <span class="border px-2 py-1 rounded text-success border-success font-weight-bold">
                        <?= $p['status'] ?>
                    </span>
                </td>
                <td>
                    
                </td>
            </tr>
        </tbody>
    <?php endforeach;?>
</table>





<?= $this->endSection(); ?>