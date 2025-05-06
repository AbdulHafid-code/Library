<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('id_user')) {
            // Redirect langsung sesuai email
            return redirect()->to(session()->get('email') === 'Admin@gmail.com' ? '/admin' : '/');
        }
        return view('auth/login');
    }


    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('user')->getWhere(['email' => $post['email']]);
        // dd($post['email'], $query->getResult());
        $user = $query->getRow();

        if ($user) {
            if ($post['nisn'] == $user->nisn) {

                // Simpan id dan email di session
                $params = [
                    'id_user' => $user->id_user,
                    'email'   => $user->email
                ];
                session()->set($params);

                // Redirect berdasarkan email
                if ($user->email === 'Admin@gmail.com') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/');
                }

            } else {
                return redirect()->to('/login')->with('error', 'NISN Tidak Sesuai');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Email Tidak Ditemukan');
        }
    }



    public function logout(){
        session()->remove('id_user');
        return redirect()->to('/login');
    }
}
