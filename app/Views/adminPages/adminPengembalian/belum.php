
<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <a href="/admin/pengembalian"><==</a><h1>Belum Dikembalikan</h1>
    </div>
</section>



<h3>Daftar Buku Yang Belum dikembalikan</h3>
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


    <?php foreach ($pinjam as $p) : ?>
        <tbody>
            <tr>
                <td><?= esc($p['nama_user']) ?></td>
                <td><?= esc($p['judul_buku']) ?></td>
                <td><?= esc($p['tanggal_pinjam']) ?></td>
                <td><?= esc($p['tanggal_kembali']) ?></td>
                <td><?= esc($p['jumlah']) ?></td>
                <td> 
                    <span class="border px-2 py-1 rounded text-danger border-danger font-weight-bold">
                        Belum dikembalikan
                    </span>
                </td>
                <td>
                    <button class="btn btn-danger btnPaksa" type="button" 
                        data-id="<?= $p['id_peminjam'] ?>">Paksa</button>
                        
                    <form action="<?= base_url('admin/pengembalian/' . $p['id_peminjam']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" >    
                        <button type="submit" class="btn btn-sm btn-success">Sudah Dikembalikan</button>
                    </form>
                </td>
            </tr>
        </tbody>
    <?php endforeach;?>
</table>


<?php if (session()->getFlashdata('success')) : ?>
  <div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
  <div class="alert alert-danger">
    <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>


<!-- Modal Paksa Pengembalian -->
<div class="modal" tabindex="-1" id="modalPaksa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Paksa Pengembalian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-block mx-auto">

        <form id="formPaksa" method="post">
            <?= csrf_field() ?>
            <label for="subJudul">Sub Judul</label>
            <input type="text" name="subJudul" id="subJudul" class="form-control" require>

            <label for="pesan">Pesan</label>
            <textarea name="pesan" id="pesan" class="form-control" require></textarea>
            <button type="submit" class="btn btn-warning">Paksa</button>
        </form>

      </div>
    </div>
  </div>
</div>





<script>

const btnPaksa = document.querySelectorAll('.btnPaksa');
const modalPaksa = document.getElementById('modalPaksa');
const formPaksa = document.getElementById('formPaksa')
const close = document.querySelectorAll('.close')

btnPaksa.forEach(item => {
    item.addEventListener('click', () => {
        const id = item.dataset.id

        formPaksa.action = `/admin/pengembalian/paksa/${id}`

        modalPaksa.style.display = 'block'
    })
});

close.forEach(item => {
    item.addEventListener('click', () => {
        modalPaksa.style.display = 'none'
    })
});

</script>


<?= $this->endSection(); ?>