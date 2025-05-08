<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\FavoritModel;
use App\Models\Users;

class FavoritController extends BaseController
{
    public function index()
    {

        $id_user = session()->get('id_user');
        $buku = new BukuModel();
        $favorit = new FavoritModel();

        $favoritSaya = $favorit->select('favorit_buku.*, user.id_user, buku.*')
                            ->join('user', 'user.id_user = favorit_buku.user_id')
                            ->join('buku', 'buku.id_buku = favorit_buku.buku_id')
                            ->where('id_user', $id_user)
                            ->orderBy('id_favorit', 'DESC')
                            ->findAll();
        
        // dd($favoritSaya);
        $data = [
          'myFavorit' => $favoritSaya,  
        ];



        return view('favorit/index', $data);
    }

    public function tambahFavorit($id_buku){
        // dd($id_buku);

        $id_user = session()->get('id_user');
        $buku = new BukuModel();
        $user = new Users();
        $favoritModel = new FavoritModel();

        $book = $buku->where('id_buku', $id_buku)->first();

        $data = [
            'buku_id' => $book['id_buku'],
            'user_id' => $id_user
        ];

        $existing = $favoritModel
            ->where('user_id', $id_user)
            ->where('buku_id', $id_buku)
            ->first();

        if (!$existing) {
            $favoritModel->insert($data);
        }

        // dd($data);

        // $favoritModel->insert($data);

        return redirect()->back();
    }

    public function hapusFavorit($id_buku){
        $id_user = session()->get('id_user');
        $favoritModel = new FavoritModel();

        // Hapus berdasarkan user dan buku
        $favoritModel
        ->where('user_id', $id_user)
        ->where('buku_id', $id_buku)
        ->delete();

        return redirect()->back();
    }
}
