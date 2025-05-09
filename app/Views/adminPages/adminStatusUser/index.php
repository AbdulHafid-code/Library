<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>



<section class="section">
    <div class="section-header">
        <h1>Status User</h1>
    </div>
</section>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">NISN</th>
      <th scope="col">Kelas</th>
      <th scope="col">Email</th>
      <th scope="col">NoHp</th>
      <th scope="col">Desc</th>
      <th scope="col">Foto Siswa</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>

  <?php $no = 1 ?>
  <?php foreach ($user as $user):?>
  <tbody>
    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?= $user['nama_user'] ?></td>
      <td><?= $user['nisn'] ?></td>
      <td><?= $user['kelas'] ?></td>
      <td><?= $user['email'] ?></td>
      <td><?= $user['NoHp'] ?></td>
      <td><?= $user['deskripsi'] ?></td>
      <td><?= $user['foto_siswa'] ?></td>
      <td><?= $user['status_user'] == '1' ? 'Aktif' : 'TerBlokir' ?></td>
      <td>
          <!-- <a href="" class="btn btn-primary">Ubah NISN</a> -->

          <?php if($user['status_user'] ==  '1'):?>
            <button type="button" class="btn btn-danger blok" data-id="<?= $user['id_user'] ?>" data-nama="<?= $user['nama_user'] ?>">Blok</button>
          <?php else:?>
            <form action="status/buka/<?= $user['id_user'] ?>" method="post">
              <?= csrf_field() ?>
              <button type="submit" class="btn btn-success btn-sm">
                  <i class="fas fa-lock-open"></i> Buka Blokir
              </button>
            </form>
          <?php endif;?>
        </td>
    </tr>
  </tbody>
  <?php endforeach; ?>
</table>




<div class="modal" tabindex="-1" id="modalBlok">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Stok Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-block mx-auto">
          <h4 id="namaUser"></h4>

          <form id="formBlok" method="post">
              <?= csrf_field() ?>
              <label for="">Sub Judul</label>
              <input type="text" name="subJudul" id="subJudul" class="form-control">
              <label for="">Pesan</label>
              <textarea type="text" name="pesan" id="pesan" class="form-control"></textarea>
              <button type="submit" class="btn btn-warning">Kirim</button>
          </form>

        </div>
      </div>
    </div>
  </div>




<script>
    const btnBlock = document.querySelectorAll('.blok')
    const namaUser = document.getElementById('namaUser')
    const formBlok = document.getElementById('formBlok')
    const modalBlock = document.getElementById('modalBlok')
    const close = document.querySelectorAll('.close')

    btnBlock.forEach(item => {
        item.addEventListener('click', () => {
            const id = item.dataset.id
            const nama = item.dataset.nama


            namaUser.textContent = nama
            formBlok.action = `/admin/status/blok/${id}`

            modalBlock.style.display = 'block'
        })
    });

    close.forEach(item => {
        item.addEventListener('click', () => {
            modalBlock.style.display = 'none'
        })
    });

</script>





<?= $this->endSection(); ?>