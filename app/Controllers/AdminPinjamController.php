<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PinjamModel;
use App\Models\BukuModel;

class AdminPinjamController extends BaseController
{
    public function index()
    {
        $pinjam = new PinjamModel();

        $data = [
            'pinjam' => $pinjam
                        ->select('peminjaman.* , user.nama_user, buku.judul_buku')
                        ->join('user', 'user.id_user = peminjaman.user_id')
                        ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                        ->where('disetujui', 'pending')
                        ->findAll()
        ];

        return view('adminPages/adminPinjam/index', $data);
    }

    public function signature(){

        $pinjam  = new PinjamModel();

        // Mengambil Id dari baris ini <input type="hidden" name="id" id="entityId">
        $id_peminjam = $this->request->getPost('id');
        // dd($id_user);
        $signatureDataUrl = $this->request->getPost('signature');

        // Tempat untuk menyimpan file ttd
        $pathFolder = ROOTPATH . 'public/signature';

        // nama Baru Untuk gambar ttd yang di upload
        $imageData = str_replace('data:image/png;base64,', '', $signatureDataUrl);
        $imageData = base64_decode($imageData);
        $namaFile = uniqid() . '.png';

        // Menyimpan file ke folder
        file_put_contents($pathFolder . '/' . $namaFile, $imageData);

        $data = [
            'disetujui' => 'diterima',
            'ttd_admin' => $namaFile,
            'tanggal_pinjam' => date('Y-m-d H:i:s'),
            'tanggal_kembali' => date('Y-m-d H:i:s', strtotime('+7 days')),
        ];
        // dd($data);

        $pinjam->update($id_peminjam, $data);

        return redirect()->to('/admin/peminjaman');
    }



    public function tolak()
    {
        $buku = new BukuModel();
        $pinjam = new PinjamModel();
        
        $id_peminjam = $this->request->getPost('id');
        
        $pinjamData = $pinjam->find($id_peminjam); // hasilnya array
        $idBuku = $buku->where('id_buku', $pinjamData['buku_id'])->first();
        
        $jumlah_pinjam = $pinjamData['jumlah'];
        $kolomDipinjamBuku = $idBuku['dipinjam'];
        
        // Kurangi dipinjam dengan jumlah yang diminta (pastikan tidak negatif)
        $dipinjam_baru = max(0, $kolomDipinjamBuku - $jumlah_pinjam);
        
        $buku->set('dipinjam', $dipinjam_baru)
            ->where('id_buku', $idBuku['id_buku'])
            ->update();

        $data = [
            'disetujui' => 'ditolak',
            'status' => 'ditolak',
            'ttd_admin' => 'Ditolak',
        ];

        $pinjam->update($id_peminjam, $data);

        return redirect()->back();  
    }


    public function riwayat(){
        $pinjam = new PinjamModel();

        $daftarPinjam = $pinjam
                            ->select('peminjaman.*, user.nama_user , buku.judul_buku')
                            ->join('user','user.id_user = peminjaman.user_id')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->groupStart()
                                ->where('disetujui', 'ditolak')
                                ->orGroupStart()
                                    ->where('disetujui', 'diterima')
                                    // data yang belum lewat tanggal kadaluarsa
                                    ->where('peminjaman.tanggal_kembali >=', date('Y-m-d H:i:s'))
                                ->groupEnd()
                            ->groupEnd()
                            ->whereIn('status', ['dipinjam', 'ditolak'])
                            ->findAll();


        $data = [
            'pinjam' => $daftarPinjam
        ];

        return view('adminPages/adminPinjam/riwayat', $data);
    }

    public function reset($id_peminjam){
        $buku = new BukuModel();
        $pinjam = new PinjamModel();

        $resetPinjam = $pinjam->find($id_peminjam);
        $idBuku = $buku->where('id_buku', $resetPinjam['buku_id'])->first();

        if ($resetPinjam) {

            if ($resetPinjam['disetujui'] === 'ditolak'){
                // dipinjam
                $kolomDipinjamBuku = $idBuku['dipinjam'];
                $jumlah_pinjam = $resetPinjam['jumlah'];

                // Kurangi dipinjam dengan jumlah yang diminta (pastikan tidak negatif)
                $dipinjam_baru = max(0, $kolomDipinjamBuku + $jumlah_pinjam);

                $buku->set('dipinjam', $dipinjam_baru)
                ->where('id_buku', $idBuku['id_buku'])
                ->update();   
            }

            $namaFile = $resetPinjam['ttd_admin'];
            $pathFile = FCPATH . 'signature/'.$namaFile;
            if (file_exists($pathFile)) {
                unlink($pathFile); // untuk menghapus
            }

            $data = [
                'tanggal_pinjam' => null,
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
                'disetujui' => 'pending',
                'ttd_admin' => null
            ];

            $pinjam->update($id_peminjam, $data);

            return redirect()->back()->with('success', 'Data peminjaman berhasil direset.');
        }
        return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
    }

}
