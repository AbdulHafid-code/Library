<?php

namespace App\Controllers;
use App\Models\BukuModel;
use App\Models\Users;
use App\Models\KategoriModel;

class Home extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel();
        $user = new Users();
        $kategori = new KategoriModel();

        $id_user = session()->get('id_user');

        // Ambil ID Kategori dari parameter GET
        $id_kategori = $this->request->getGet('id_kategori');
        // dd($id_kategori);
        // Ambil semua Kategori
        $kategori = $kategori->findAll();

        // Jika filter Kategori dipilih
        if ($id_kategori) {
            $buku = $bukuModel->select('buku.*, kategori.nama_kategori')
                                    ->join('kategori', 'kategori.id_kategori = buku.kategori_id')
                                    ->where('buku.kategori_id', $id_kategori)
                                    ->findAll();
        } else {
            // Jika tidak ada filter, tampilkan semua mahasiswa
            $buku = $bukuModel->select('buku.*, kategori.nama_kategori')
                                    ->join('kategori', 'kategori.id_kategori = buku.kategori_id')
                                    ->findAll();
        }

        $data = [
            'buku' => $buku,
            'kategori' => $kategori,
            'id_kategori' => $id_kategori,
            'user' => $user->find($id_user)
        ];

        // dd($id_kategori);
        return view('pages/home', $data);
    }

    public function detail($slug){

        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->getBuku($slug);

        return view('pages/detail', $data);
    }
}
