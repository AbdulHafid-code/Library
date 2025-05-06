<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\PinjamModel;


class PinjamController extends BaseController
{
    public function index($slug)
    {

        $bukuModel = new BukuModel();

        $buku = $bukuModel->where('slug', $slug)->first();

        $data = [
            'buku' => $buku,
        ];
        
        return view('pinjam/index', $data);
    }

    public function proses($slug)
{
    $pinjam = new PinjamModel();
    $bukuModel = new BukuModel();

    $id_user = session()->get('id_user');
    $jumlah = (int) $this->request->getPost('jumlah'); // Ambil jumlah dari form
    
    $buku = $bukuModel->where('slug', $slug)->first();
    $id_buku = $buku['id_buku'];

    // Validasi stok tersedia
    $stok_tersedia = $buku['stok'] - $buku['dipinjam'];
    if (!$buku || $jumlah > $stok_tersedia || $jumlah <= 0) {
        return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia!');
    }

    // Tambah data peminjaman
    $pinjam->save([
        'user_id' => $id_user,
        'buku_id' => $id_buku,
        'jumlah' => $jumlah,
        'status' => 'dipinjam'
    ]);

    // Update jumlah dipinjam
    $bukuModel->update($id_buku, [
        'dipinjam' => $buku['dipinjam'] + $jumlah
    ]);

    return redirect()->to('/')->with('success', 'Buku berhasil dipinjam!');
}



}
