<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1 class="mr-5">Stok Buku</h1>

        <form class="form-inline mr-auto" action="<?= base_url('admin/stok') ?>" method="post">
            <?= csrf_field() ?>
          <div class="search-element">
            <input class="form-control" type="text" name="keyword" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>

    </div>
</section>


<h3>Daftar Semua Buku</h3>
<table class="table">
    <thead>
        <tr>
            <th>No. </th>
            <th>Judul Buku</th>
            <th>Sampul</th>
            <th>Stok</th>
            <th>Dipinjam</th>
            <th>Sisa</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <?php $no = 1 ?>
    <?php foreach ($buku as $item):?>
    <tbody>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $item['judul_buku'] ?></td>
            <td><img src="/sampul/<?= $item['sampul'] ?>" width="80" alt=""></td>
            <td><?= $item['stok'] ?></td>
            <td><?= $item['dipinjam'] ?></td>
            <td><?= $item['sisaBuku'] ?></td>
            <td>
            <button 
            type="button" 
            class="btn btn-warning btnTambah" 
            data-id="<?= $item['id_buku'] ?>"
            data-judul="<?= $item['judul_buku'] ?>"
            data-sampul="/sampul/<?= $item['sampul'] ?>">
            Tambah
            </button>
                
            <button type="button" class="btn btn-danger btnKurangi" data-id="<?= $item['id_buku'] ?>" data-sampul="/sampul/<?= $item['sampul'] ?>" data-judul="<?= $item['judul_buku'] ?>" >
              Kurangi
            </button>
            </td>
        </tr>
    </tbody>
    <?php endforeach?>
            
</table>





  <!-- Pop Up Tambah -->
  <div class="modal" tabindex="-1" id="modalTambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Stok Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-block mx-auto">
          <img id="modalSampul" src="" width="120" alt="">
          <h4 id="modalJudul"></h4>

          <form id="formTambah" method="post">
              <?= csrf_field() ?>
              <label for="">Tambah Stok</label>
              <input type="number" name="tambah" id="tambah" class="form-control">
              <button type="submit" class="btn btn-warning">Tambah</button>
          </form>

        </div>
      </div>
    </div>
  </div>


<!-- Pop Up Kurangi -->
<div class="modal" tabindex="-1" id="modalKurangi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kurangi Stok Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-block mx-auto">
        <img id="Sampul" src="" width="120" alt="">
        <h4 id="Judul"></h4>

        <form id="formKurangi" method="post">
            <?= csrf_field() ?>
            <label for="">Kurangi Stok</label>
            <input type="number" name="kurangi" id="kurangi" class="form-control">
            <button type="submit" class="btn btn-warning">Kurangi</button>
        </form>

      </div>
    </div>
  </div>
</div>






<script>
    const btnTambah = document.querySelectorAll('.btnTambah');
    const popUp = document.getElementById('modalTambah');
    const modalJudul = document.getElementById('modalJudul');
    const modalSampul = document.getElementById('modalSampul');
    const formTambah = document.getElementById('formTambah');
    const btnClose = document.querySelectorAll('.close')


    btnTambah.forEach(item => {
        item.addEventListener('click', () => {
            const id = item.dataset.id
            const judul = item.dataset.judul
            const sampul = item.dataset.sampul

            modalJudul.textContent = judul;
            modalSampul.src = sampul;
            formTambah.action = `/admin/stok/tambah/${id}`;

            popUp.style.display = 'block'
        })
    });

    // KURANGI
    const btnkurangi = document.querySelectorAll('.btnKurangi')
    const popupKurangi = document.getElementById('modalKurangi');
    const formKurangi = document.getElementById('formKurangi');
    const Elsampul = document.getElementById('Sampul');
    const Eljudul = document.getElementById('Judul');

    // const 
    btnkurangi.forEach(item => {
      item.addEventListener('click', () => {
        const id = item.dataset.id;
        const judul = item.dataset.judul;
        const sampul = item.dataset.sampul;

        Eljudul.textContent = judul
        Elsampul.src = sampul
        formKurangi.action = `/admin/stok/kurangi/${id}`

        popupKurangi.style.display = 'block';
      })
    });


    btnClose.forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.modal').forEach(modal => {
          modal.style.display = 'none';
        });
      });
    });



</script>

<?= $this->endSection(); ?>
