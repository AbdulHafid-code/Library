<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;

class AdminStokController extends BaseController
{
    public function index()
    {

        $buku = new BukuModel();

        // Ambil data dari input POST jika formulir dikirimkan
        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            // dd($keyword); // Debug untuk cek apakah keyword sudah diterima

            // tampilkan data sesuain pencarian user yang di post lewat keyword
            $bukuList = $buku->search($keyword);
        } else {
            $bukuList = $buku->orderBy('id_buku', 'DESC')->findAll();;
        }

        // Tambahkan kolom sisaBuku ke setiap item
        foreach ($bukuList as &$item) {
            $item['sisaBuku'] = $item['stok'] - $item['dipinjam'];
        }

        $data = [
            'buku' => $bukuList,
        ];

        return view('adminPages/adminstok/index', $data);
    }

    public function tambah($id_buku){
        $buku = new BukuModel();

        $book = $buku->where('id_buku', $id_buku)->first();
        $jumlah = $this->request->getPost('tambah');

        $stok = $book['stok'] + $jumlah;

        $buku->update($id_buku, ['stok' => $stok]);

        return redirect()->back();
    }

    public function kurangi($id_buku){
        $buku = new BukuModel();
        $book = $buku->where('id_buku', $id_buku)->first();
        $jumlah = $this->request->getPost('kurangi');
        $jumlahSebelumnya = $book['stok'];
        // dd($jumlahSebelumnya);

        if ($jumlah >= $jumlahSebelumnya) {
            echo '<script>
                alert("Jumlah Kurangi Lebih Banyak Dari Jumlah Buku");
                window.history.back();

                console.log(`ok`)
            </script>';
            
            return;
        } else {
            $stok = $book['stok'] - $jumlah;
            $buku->update($id_buku, ['stok'=> $stok]);

            return redirect()->back();
        }
    }
}
