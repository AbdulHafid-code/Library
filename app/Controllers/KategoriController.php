<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriModel;
use App\Models\BukuModel;
use App\Models\RatingModel;

class KategoriController extends BaseController
{
    public function index()
    {
        
    }

    public function kategori($nk)
    {
        $kategori = new KategoriModel();
        $buku = new BukuModel();
        $ratingModel = new RatingModel();

        // Ambil data kategori berdasarkan nama_kategori
        $kategoriData = $kategori->where('nama_kategori', $nk)->first();

        $id_kategori = $kategoriData['id_kategori'];
        $bukuKategori = $buku->where('kategori_id', $id_kategori)->findAll();
        foreach ($bukuKategori as &$buku) {
            $avg = $ratingModel
                ->selectAvg('rating')
                ->where('buku_id', $buku['id_buku'])
                ->first();

                $buku['avg_rating'] = $avg['rating'] ?? 0;
                $buku['stok_tersedia'] = $buku['stok'] - $buku['dipinjam'];    
        }

        $data = [
            'bukuKategori' =>$bukuKategori,
            'kategori' => $kategoriData,
        ];

        return view('kategori/index', $data);
    }
}
