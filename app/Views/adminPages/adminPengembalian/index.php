<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Pengembalian </h1> 
            <a href="pengembalian/sudah" class="btn btn-warning ml-3">Sudah Dikembalikan</a>
            <a href="pengembalian/belum" class="btn btn-danger ml-3">Belum Dikembalikan</a>
    </div>
</section>


<h3>Daftar Pengembalian</h3>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <?php foreach ($pinjam as $item):?>
    <tbody>
        <tr>
            <td><?= $item['nama_user'] ?></td>
            <td><?= $item['judul_buku'] ?></td>
            <td><?= $item['tanggal_pinjam'] ?></td>
            <td><?= $item['tanggal_kembali'] ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td><?= $item['status'] ?></td>
            <td>
                <form action="<?= base_url('admin/pengembalian/' . $item['id_peminjam']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" >    
                <button type="submit" class="btn btn-sm btn-success">Sudah Dikembalikan</button>
                </form>
            </td>
        </tr>
    </tbody>
    <?php endforeach ?>
</table>



<!-- Modal Signature -->
 <div id="signatureModal" class="modal">
    <div class="modal-content">
        
        <div class="modal-header">
            <h5 class="modal-title" id="signatureModalLabel">Tanda Tangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="outline:none;  box-shadow: none ;">&times;</span>
            </button>
        </div>

        <canvas id="signature-pad"></canvas>

        <div class="button-container">
            <button id="clear" class="btn-clear btn btn-danger">Reset</button>
            <button id="save" class="btn-save btn btn-success">Simpan</button>
        </div>

        <form action="peminjaman/signature" method="post" id="signature-form">
            <?= csrf_field() ?>
            <input type="hidden" name="signature" id="signature">
            <input type="hidden" name="id" id="entityId">
        </form>

    </div>
 </div>
 


<?= $this->endSection(); ?>
