<!DOCTYPE html>
<html>
<head>
    <title>Laporan Bulanan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Bulanan Perpustakaan</h2>
    <p>Bulan: <?= $bulan ?> - Tahun: <?= $tahun ?></p>
    <p>Jumlah Buku Dipinjam: <?= count($jumlahDipinjam) ?></p>
    <p>Jumlah Buku Dikembalikan: <?= count($jumlahDikembalikan) ?></p>
    <p>Buku Paling Populer: <?= $bukuPopuler['judul'] ?? '-' ?></p>
</body>
</html>
