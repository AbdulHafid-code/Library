<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;
use App\Models\PinjamModel;
use App\Models\BukuModel;


class ProfilController extends BaseController
{
    // public function index()
    // {
    //     $id_user = session()->get('id_user');
        
    //     $pinjamModel = new PinjamModel();
    //     $userModel = new Users();

    //     $peminjaman = $pinjamModel->getPeminjamanByUser($id_user);

    //     $data = [
    //         'user' => $userModel->find($id_user),
    //         'peminjaman' => $peminjaman,
    //     ];

    //     return view('profil/index', $data);
    // }

    public function index()
{
    return redirect()->to('/profil'); // PRG pattern
}
public function show()
{
    $id_user = session()->get('id_user');

    $pinjamModel = new PinjamModel();
    $userModel = new Users();

    $peminjaman = $pinjamModel->getPeminjamanByUser($id_user);

    $data = [
        'user' => $userModel->find($id_user),
        'peminjaman' => $peminjaman,
    ];

    return view('profil/index', $data);
}


    public function save($id_user){
        $user = new Users();

        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'NoHp' => $this->request->getPost('NoHp'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];
        // dd($data);        

        $user->update($id_user, $data);

        return redirect()->back();
    }




    // public function pinjam()
    // {
    //     $id_user = session()->get('id_user');
    //     $pinjamModel = new \App\Models\PinjamModel();
    //     $bukuModel = new \App\Models\BukuModel();

    //     $peminjaman = $pinjamModel
    //         ->join('buku', 'buku.id_buku = peminjaman.buku_id')
    //         ->where('user_id', $id_user)
    //         ->select('peminjaman.*, buku.judul_buku, buku.sampul')
    //         ->orderBy('tanggal_pinjam', 'DESC')
    //         ->findAll();

    //     return view('user/profil', [
    //         'peminjaman' => $peminjaman
    //     ]);
    // }

}
