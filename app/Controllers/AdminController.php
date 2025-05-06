<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriModel;
use App\Models\BukuModel;

class AdminController extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel();
        $data = [
            'buku' => $bukuModel->orderBy('id_buku', 'DESC')->findAll(),
            'totalBuku' => $bukuModel->countAll(),
        ];

        return view('adminPages/adminHome/index', $data);
    }

    public function create(){
        $kategoriModel = new kategoriModel(); // Panggil model kategori
        $data['kategori'] = $kategoriModel->findAll(); // Ambil semua kategori

        return view('adminPages/adminHome/create', $data);
    }

    public function store()
    {
        $bukuModel = new bukuModel(); 
        $validation = \Config\Services::validation();

        // Validasi data Yang di masukkan
        if (!$this->validate([
            'judul_buku' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Judul buku harus diisi.',
                    'min_length' => 'Judul buku minimal 3 karakter.',
                    'max_length' => 'Judul buku maksimal 255 karakter.'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Sampul harus diunggah.',
                    'max_size' => 'Ukuran sampul maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Format gambar harus JPG, JPEG, atau PNG.'
                ]
            ],
            'penulis' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Penulis harus diisi.',
                    'min_length' => 'Nama penulis minimal 3 karakter.',
                    'max_length' => 'Nama penulis maksimal 255 karakter.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Penerbit harus diisi.',
                    'min_length' => 'Nama penerbit minimal 3 karakter.',
                    'max_length' => 'Nama penerbit maksimal 255 karakter.'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tahun terbit harus diisi.',
                    'valid_date' => 'Format tahun terbit tidak valid.'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih.',
                    // 'integer' => 'Kategori tidak valid.'
                ]
            ],
            'jumlah_halaman' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah halaman harus diisi.',
                    'numeric' => 'Jumlah halaman harus berupa angka.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $slug = url_title($this->request->getVar('judul_buku'), '-', true); //menjadikan judul huruf kecil semua
        // dd($slug);

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // dd($fileSampul); 

        // apakah tidak ada gambar yang di upload
        if ($fileSampul->getError() == 4) {
            $nameSampul = 'default.png';
        } else {
            // generate name file sampul
            $nameSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder img
            $fileSampul->move('sampul', $nameSampul);
        }

        // dd($this->request->getFile('sampul'));

        $bukuModel->insert([
            'judul_buku' => $this->request->getVar('judul_buku'),
            'slug' => $slug,
            'sampul' => $nameSampul,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'stok' => $this->request->getVar('stok'),
            'jumlah_halaman' => $this->request->getVar('jumlah_halaman'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ]);
        

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/admin');
    }


    public function delete($id){
        $bukuModel = new BukuModel();

        $buku = $bukuModel->find($id);

        // cek jika file gambarnya default
        if ($buku['sampul'] != 'default.png') {
            // menghapus gambar
            unlink('sampul/' . $buku['sampul']);
        }

        $bukuModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');

        return redirect()->to('/admin');
    }

    public function edit($slug){
        $bukuModel = new BukuModel();
        $kategoriModel = new KategoriModel();
        // dd($slug);
        $buku = $bukuModel->getBuku($slug);
        // dd($buku);
        if (!$buku) {
            return redirect()->to('/admin')->with('error', 'Buku tidak ditemukan');
        }
        $kategori = $kategoriModel->findAll();

        $data = [
            'buku' => $buku,
            'kategori' => $kategori,
        ];

        // dd($data);

        return view('/adminPages/adminHome/edit', $data);
    }

    public function update($id){
        $bukuModel = new bukuModel();

        // Validasi data Yang di masukkan
        if (!$this->validate([
            'judul_buku' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Judul buku harus diisi.',
                    'min_length' => 'Judul buku minimal 3 karakter.',
                    'max_length' => 'Judul buku maksimal 255 karakter.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran sampul maksimal 2MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Format gambar harus JPG, JPEG, atau PNG.'
                ]
            ],
            'penulis' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Penulis harus diisi.',
                    'min_length' => 'Nama penulis minimal 3 karakter.',
                    'max_length' => 'Nama penulis maksimal 255 karakter.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Penerbit harus diisi.',
                    'min_length' => 'Nama penerbit minimal 3 karakter.',
                    'max_length' => 'Nama penerbit maksimal 255 karakter.'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tahun terbit harus diisi.',
                    'valid_date' => 'Format tahun terbit tidak valid.'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih.',
                    // 'integer' => 'Kategori tidak valid.'
                ]
            ],
            'jumlah_halaman' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah halaman harus diisi.',
                    'numeric' => 'Jumlah halaman harus berupa angka.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $fileSampul = $this->request->getFile('sampul');

        // cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $nameSampul = $this->request->getVar('sampulLama');
        }else {
            // generate nama sampul random
            $nameSampul = $fileSampul->getRandomName();
            // pindahkan gambar baru ke folder 'img'
            $fileSampul->move('sampul', $nameSampul);
            
            // hapus file lama
            $sampulLama = $this->request->getVar('sampulLama');
            $filePath = 'sampul/' . $sampulLama;

            if (!empty($sampulLama) && is_file($filePath)) {
                unlink($filePath); // hapus file lama jika ada
            }
        }

        $slug = url_title($this->request->getVar('judul_buku'), '-', true);

        $data = [
            'judul_buku' => $this->request->getVar('judul_buku'),
            'slug' => $slug,
            'sampul' => $nameSampul,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'stok' => $this->request->getVar('stok'),
            'jumlah_halaman' => $this->request->getVar('jumlah_halaman'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];
        
        if (!empty($data['judul_buku']) || !empty($data['penulis']) || !empty($data['penerbit']) || !empty($data['tahun_terbit']) || !empty($data['kategori_id']) || !empty($data['stok']) || !empty($data['jumlah_halaman']) || !empty($data['deskripsi'])) {
            // Cek jika ada data yang akan diupdate
            $bukuModel->update($id, $data);
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang diperbarui.');
        }
        
        

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');

        return redirect()->to('/admin');
    }

}
