<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\RatingModel;
use App\Models\FavoritModel;
use App\Models\PinjamModel;
use Dompdf\Dompdf;


class AdminLaporanController extends BaseController
{
    public function index()
    {
        $buku = new BukuModel();
        $rating = new RatingModel();
        $pinjam = new PinjamModel();
        $favorit = new FavoritModel();

        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        
        $jumlahDipinjam = $pinjam
                            ->select('peminjaman.*, buku.*, user.*')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->where('MONTH(tanggal_pinjam)', $bulan)
                            ->where('YEAR(tanggal_pinjam)', $tahun)
                            ->findAll();
                            // ->countAllResults();
        // dd($jumlahDipinjam);
        $jumlahDikembalikan = $pinjam
                            ->select('peminjaman.*, buku.*, user.*')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->where('MONTH(tanggal_kembali)', $bulan)
                            ->where('YEAR(tanggal_kembali)', $tahun)
                            ->where('status', 'dikembalikan')
                            ->findAll();
                            // ->countAllResults();
        
        // buku paling populer
        $bukuPopuler = $buku->getBukuPopuler();
        // dd($bukuPopuler);

        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jumlahDipinjam' => $jumlahDipinjam,
            'jumlahDikembalikan' => $jumlahDikembalikan,
            'bukuPopuler' => $bukuPopuler
        ];

        // dd($data);

        return view('adminPages/adminLaporan/index', $data);
    }


    public function exportpdf(){
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $buku = new BukuModel();
        $pinjam = new PinjamModel();

        $jumlahDipinjam = $pinjam
                            ->select('peminjaman.*, buku.*, user.*')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->where('MONTH(tanggal_pinjam)', $bulan)
                            ->where('YEAR(tanggal_pinjam)', $tahun)
                            ->findAll();
                            // ->countAllResults();
        // dd($jumlahDipinjam);
        $jumlahDikembalikan = $pinjam
                            ->select('peminjaman.*, buku.*, user.*')
                            ->join('buku', 'buku.id_buku = peminjaman.buku_id')
                            ->join('user', 'user.id_user = peminjaman.user_id')
                            ->where('MONTH(tanggal_kembali)', $bulan)
                            ->where('YEAR(tanggal_kembali)', $tahun)
                            ->where('status', 'dikembalikan')
                            ->findAll();
                            // ->countAllResults();
        
        // buku paling populer
        $bukuPopuler = $buku->getBukuPopuler();
        // dd($bukuPopuler);

        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jumlahDipinjam' => $jumlahDipinjam,
            'jumlahDikembalikan' => $jumlahDikembalikan,
            'bukuPopuler' => $bukuPopuler
        ];

        // Load view ke dalam DomPDF
        $dompdf = new Dompdf();
        $html = view('adminPages/adminLaporan/pdf', $data);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Download file
        $dompdf->stream("laporan_bulanan_{$bulan}_{$tahun}.pdf", ['Attachment' => false]);
    
    }
}
