<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;

class AdminStatusController extends BaseController
{
    public function index()
    {
        $user = new Users();

        $data = [
            'user' => $user->where('id_user !=', 1)->findAll(),
        ];

        return view('adminPages/adminStatusUser/index', $data);
    }

    public function blok($id_user){
        $user = new Users();
        $userData = $user->where('id_user', $id_user)->first();
        $adminEmail = $user->find(1);

        $data = [
            'status_user' => '0'
        ];
        $user->update($id_user, $data);

        $subJudul = $this->request->getPost('subJudul');
        $pesan = $this->request->getPost('pesan');

        $email = service('email');
        $emailTujuan = $userData['email'];

        $email->setTo($emailTujuan);
        $email->setFrom($adminEmail['email'], 'Admin Perpustakaan');
        $email->setSubject($subJudul);
        $email->setMessage($pesan);

        if ($email->send()) {
            session()->setFlashdata('success', 'Email berhasil dikirim!');
        } else {
            session()->setFlashdata('error', 'Email gagal dikirim: ' . $email->printDebugger(['headers']));
        } 

        return redirect()->back();
    }


    public function buka($id_user){
        $user = new Users();
        $userData = $user->where('id_user', $id_user)->first();
        $adminEmail = $user->find(1);

        $data = [
            'status_user' => '1'
        ];
         $user->update($id_user, $data);


        $email = service('email');
        $emailTujuan = $userData['email'];

        $email->setTo($emailTujuan);
        $email->setFrom($adminEmail['email'], 'Admin Perpustakaan');
        $email->setSubject(' Akun Anda Telah Diaktifkan Kembali');
        $email->setMessage( 
            "
            Halo {$userData['nama_user']},

            Kami ingin menginformasikan bahwa akun Anda di Sistem Perpustakaan kami telah diaktifkan kembali. Anda sekarang dapat kembali login dan menggunakan semua fitur yang tersedia seperti biasa.

            Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, silakan hubungi admin melalui email ini.

            Terima kasih atas perhatian dan kerjasamanya.

            Salam hangat,  
            Admin Perpustakaan
            "
        );

        if ($email->send()) {
            session()->setFlashdata('success', 'Email berhasil dikirim!');
        } else {
            session()->setFlashdata('error', 'Email gagal dikirim: ' . $email->printDebugger(['headers']));
        } 

        return redirect()->back();
    }
}
