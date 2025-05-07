<?php

namespace App\Controllers;
use App\Models\BukuModel;
use App\Models\FavoritModel;
use App\Models\Users;
use App\Models\KategoriModel;
use App\Models\RatingModel;

class Home extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel();
        $user = new Users();
        $kategori = new KategoriModel();
        $ratingModel = new RatingModel();
        $favoritModel = new FavoritModel();

        $id_user = session()->get('id_user');

        $bukuList = $bukuModel->findAll(); // Loop semua buku dan ambil rata-rata ratingnya
        foreach ($bukuList as $buku) {
            $avg = $ratingModel
                    ->selectAvg('rating')
                    ->where('buku_id', $buku['id_buku'])
                    ->first();

            $buku['avg_rating'] = $avg['rating'] ?? 0;
            $buku['stok_tersedia'] = $buku['stok'] - $buku['dipinjam'];    
        }

        $bukuRandom = $bukuModel->orderBy('RAND()')->findAll(); // atau query random kalau kamu pakai itu
        foreach ($bukuRandom as &$buku){
            $avg = $ratingModel
                ->selectAvg('rating')
                ->where('buku_id', $buku['id_buku'])
                ->first();

                // Ambil favorit user untuk buku ini
                $favoritUser = $favoritModel
                ->where('user_id', $id_user)
                ->where('buku_id', $buku['id_buku'])
                ->first();

            $buku['avg_rating'] = $avg['rating'] ?? 0;
            $buku['stok_tersedia'] = $buku['stok'] - $buku['dipinjam'];
            $buku['favoritUser'] = $favoritUser;
            $buku['total_favorit'] = $favoritModel->where('buku_id', $buku['id_buku'])->countAllResults();
        }
        // dd($bukuRandom);
        


        $data = [
            'buku' => $bukuList,
            'bukuRandom' => $bukuRandom,
            'user' => $user->find($id_user),
            'kategori' => $kategori->findAll(),
            'favoritUser' => $favoritUser
            // 'bukuRandom' => $bukuModel->orderBy('RAND()')->findAll(),
            // 'bukuList' => $bukuList,
        ];

        return view('pages/home', $data);
    }

    public function detail($slug)
    {
        $bukuModel = new \App\Models\BukuModel();
        $ratingModel = new \App\Models\RatingModel();

        // Ambil buku berdasarkan slug
        $buku = $bukuModel->where('slug', $slug)->first();
        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Buku tidak ditemukan.");
        }

        // Ambil ID user dari session
        $id_user = session()->get('id_user');

        // Ambil rating user untuk buku ini
        $ratingUser = $ratingModel
                        ->where('user_id', $id_user)
                        ->where('buku_id', $buku['id_buku'])
                        ->first();

        $data = [
            'buku' => $bukuModel->getBuku($slug),
            'ratingUser' => $ratingUser ? $ratingUser['rating'] : 0, // Jika user belum memberi rating, beri 0
        ];

        return view('pages/detail', $data);
    }

    public function rating($id_buku)
    {
        // dd($id_buku);
        $ratingModel = new RatingModel();
    
        $id_user = session()->get('id_user');
        $rating = $this->request->getPost('rating');
    
        // Cek apakah user sudah memberi rating
        $existing = $ratingModel->where('user_id', $id_user)->where('buku_id', $id_buku)->first();
        // dd($existing);
    
        if ($existing) {
            // Update rating
            $ratingModel->update($existing['id_rating'], ['rating' => $rating]);
        } else {
            // Tambah rating baru
            $data = [
                'user_id' => $id_user,
                'buku_id' => $id_buku,
                'rating' => $rating
            ];
            $ratingModel->insert($data);
        }
    
        return redirect()->back()->with('success', 'Rating berhasil disimpan!');
    }

    
}
