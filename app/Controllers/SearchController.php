<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\RatingModel;

class SearchController extends BaseController
{
    // public function index()
    // {
    //     $buku = new BukuModel();
    //     // Ambil data dari input POST jika formulir dikirimkan
    //     $keyword = $this->request->getPost('keyword');
        
    //     // Inisialisasi variabel $book dengan nilai default
    //     $book = [];

    //     if ($keyword) {
    //         // tampilkan data sesuain pencarian user yang di post lewat keyword
    //         $book = $buku->search($keyword) ;
    //     }else {
    //         $book = $buku;
    //     }
        
    //     $data = [
    //         'buku' => $book,
    //     ];

    //     return view('pages/search/index', $data);
    // }


    public function index()
    {
        $buku = new BukuModel();
        $ratingModel = new RatingModel();
        $keyword = $this->request->getGet('keyword');
        $book = $keyword ? $buku->search($keyword) : $buku->findAll();

        foreach ($book as &$item) {
            $avg = $ratingModel
                    ->selectAvg('rating')
                    ->where('buku_id', $item['id_buku'])
                    ->first();
        
            $item['avg_rating'] = $avg['rating'] ?? 0;
            $item['stok_tersedia'] = $item['stok'] - $item['dipinjam'];
        }        

        return view('pages/search/index', ['buku' => $book]);
    }
}
