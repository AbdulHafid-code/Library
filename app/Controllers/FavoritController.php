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
        //
    }

    public function tambahFavorit($id_buku){
        // dd($id_buku);

        $id_user = session()->get('id_user');
        $buku = new BukuModel();
        $user = new Users();
        $favoritModel = new FavoritModel();

        // $book = $buku->where('id_buku', $id_buku)->first();

        $data = [
            'buku_id' => $id_buku,
            'user_id' => $id_user
        ];

        $favoritModel->insert($data);

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
