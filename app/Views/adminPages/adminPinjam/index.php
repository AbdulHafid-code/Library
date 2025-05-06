<?= $this->extend('adminLayout/default') ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="section-header">
        <h1>Peminjaman</h1> <a href="peminjaman/riwayat" class="btn btn-warning ml-3">Riwayat</a>
    </div>
</section>


<h3>Daftar Peminjaman Menunggu Persetujuan</h3>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <?php if(empty($pinjam)):?>
        <tbody>
            <tr>
                <td colspan="5" class="text-center">Belum Ada Data Baru</td>
            </tr>
        </tbody>
    <?php else:?>

        <?php $adaYangBelumTTD = false; ?>
        <?php
            foreach ($pinjam as $p) :
                if (empty($p['ttd_admin'])) {
                    $adaYangBelumTTD = true; ?>
            <tbody>
                <tr>
                    <td><?= esc($p['nama_user']) ?></td>
                    <td><?= esc($p['judul_buku']) ?></td>
                    <td><?= esc($p['tanggal_pinjam']) ?></td>
                    <td><?= esc($p['jumlah']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning add-signature" data-id="<?= $p['id_peminjam'] ?>">Setujui</button>
                        <form action="<?= base_url('admin/peminjaman/tolak') ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= esc($p['id_peminjam']) ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                        </form>

                    </td>
                </tr>
            </tbody>
        <?php } endforeach;?>

        <?php if (!$adaYangBelumTTD): ?>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">Belum Ada Data yang belum ttd</td>
                </tr>
            </tbody>
        <?php endif; ?>
            
    <?php endif; ?>
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
 
 
 <style>
    body { font-family: Arial, sans-serif; }
    .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
    .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 600px; }
    .close, .close-response { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
    .close:hover, .close:focus, .close-response:hover, .close-response:focus { color: black; text-decoration: none; cursor: pointer; }
    #signature-pad { border: 1px solid #ccc; width: 100%; height: 200px; }
    .button-container { display: flex; justify-content: space-between; margin-top: 10px; }
    .btn-clear { background-color: red; color: white; border: none; padding: 10px 20px; cursor: pointer; }
    .btn-save { background-color: green; color: white; border: none; padding: 10px 20px; cursor: pointer; }
</style>







 <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
 <script>
    let signatureModal = document.getElementById('signatureModal');
    let close = document.getElementsByClassName('close')[0];
    let canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);
    let clear = document.getElementById('clear');
    let save = document.getElementById('save');
    let signatureInput = document.getElementById('signature');
    let entityIdInput = document.getElementById('entityId');


    // ketika tombol dengan class=".add-signature"
    document.querySelectorAll('.add-signature').forEach(element => {
        element.addEventListener('click', () => {
            bukaTTD(element.getAttribute('data-id'));
        })
    });

    // tombol Close
    close.addEventListener('click', () => {
        signatureModal.style.display = 'none';
    })

    // membersihkan ttd
    clear.addEventListener('click', () => {
        signaturePad.clear();
    })

    // menyimpan ttd
    save.addEventListener('click', () => {
        if (!signaturePad.isEmpty()) {
            signatureInput.value = signaturePad.toDataURL('image/png');

            console.log(`Ok Data ${signaturePad.toDataURL('image/png')} Berhasil Tersimpan `);
            

            document.getElementById('signature-form').submit();
        } else {
            alert("TTD Tidak Boleh Kosong")
        }
    })


    // Function TTd/untuk memunculkan popup
    function bukaTTD(id) {
        entityIdInput.value = id;
        signatureModal.style.display = 'block';
        resizeCanvas();
        signaturePad.clear;
    }


    // Function Canvas
    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }
    window.onresize = resizeCanvas;
    resizeCanvas();

 </script>

<?= $this->endSection(); ?>
