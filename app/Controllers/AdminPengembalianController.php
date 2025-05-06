<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PinjamModel;
use App\Models\Users;

class AdminPengembalianController extends BaseController
{
    public function index()
    {

        $pinjamModel = new PinjamModel();

        $data = [
            'pinjam' => $pinjamModel
                            ->select('peminjaman.*, user.nama_user, buku.judul_buku')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->where('tanggal_kembali >=', date('Y-m-d H:i:s'))
                            ->where('disetujui', 'diterima')
                            ->where('status', 'dipinjam')
                            ->findAll()
        ];


        return view('adminPages/adminPengembalian/index', $data);
    }

    public function sudahKembali($id_pinjam){
        // dd($id_pinjam);
        $pinjam = new PinjamModel();

        $status = [
            'status' => 'dikembalikan'
        ];

        $pinjam->update($id_pinjam, $status);

        return redirect()->back();
    }

    public function sudah(){
        
        $pinjamModel = new PinjamModel();

        $data = [
            'pinjam' => $pinjamModel
                            ->select('peminjaman.*, user.nama_user , buku.judul_buku')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->where('status', 'dikembalikan')
                            ->findAll()
        ];


        return view('adminPages/AdminPengembalian/sudah', $data);
    }

    public function belum(){
        
        $pinjamModel = new PinjamModel();

        $data = [
            'pinjam' => $pinjamModel
                            ->select('peminjaman.*, user.nama_user , buku.judul_buku')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->where('disetujui', 'diterima')
                            ->where('status', 'dipinjam')
                            // data yang sudah lewat tanggal kadaluarsa 
                            ->where('peminjaman.tanggal_kembali <', date('Y-m-d H:i:s'))
                            ->findAll()
        ];
        return view('adminPages/AdminPengembalian/belum', $data);
    }


    public function paksa($id_pinjam){
         $pinjamModel = new PinjamModel();
         $userModel = new Users();

        $emailAdmin = $userModel->find(1);
        // dd($emailAdmin);
         $pinjam = $pinjamModel
                    ->select('peminjaman.*, user.email')
                    ->join('user', 'user.id_user = peminjaman.user_id')
                    ->where('id_peminjam', $id_pinjam)->first();
        //  dd($pinjam);

        $subJudul = $this->request->getPost('subJudul');
        $pesan = $this->request->getPost('pesan');


        // Kirim email notifikasi
        $email = service('email');
        $emailTujuan = $pinjam['email'];
        // dd($emailTujuan);

        $email->setTo($emailTujuan);
        $email->setFrom($emailAdmin['email'], 'Admin Perpustakaan');
        $email->setSubject($subJudul);
        $email->setMessage($pesan);

        if ($email->send()) {
            session()->setFlashdata('success', 'Email berhasil dikirim!');
        } else {
            session()->setFlashdata('error', 'Email gagal dikirim: ' . $email->printDebugger(['headers']));
        }        

        return redirect()->back();
    }
}
