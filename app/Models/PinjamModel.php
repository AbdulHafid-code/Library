<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjam';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'buku_id', 'jumlah', 'tanggal_pinjam', 'tanggal_kembali', 'status', 'disetujui', 'ttd_admin'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];


    public function getPeminjamanByUser($userId)
{
    return $this->join('buku', 'buku.id_buku = peminjaman.buku_id')
                ->where('peminjaman.user_id', $userId)
                ->select('peminjaman.*, buku.judul_buku, buku.sampul')
                ->orderBy('tanggal_pinjam', 'DESC')
                ->findAll();
}



}
