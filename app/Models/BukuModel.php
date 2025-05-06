<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['judul_buku', 'slug', 'sampul', 'penulis', 'penerbit', 'tahun_terbit', 'kategori_id', 'stok', 'dipinjam', 'jumlah_halaman', 'deskripsi'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];


    public function getBuku($slug = false)
        {
            // jika slugnya kosong cari semua data
            if ($slug == false) {
                return $this->select('buku.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = buku.kategori_id', 'left')
                    ->findAll();
            }

            // kalau ada slugnya tampilin ini
            return $this->select('buku.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = buku.kategori_id', 'left')
            ->where(['slug' => $slug])
            ->first();
        }

        public function search($keyword)
        {
            return $this->like('judul_buku', $keyword)->findAll();
        }
}