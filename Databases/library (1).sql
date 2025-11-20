-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Bulan Mei 2025 pada 04.05
-- Versi server: 8.0.30
-- Versi PHP: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` int NOT NULL,
  `kategori_id` int NOT NULL,
  `stok` int NOT NULL,
  `dipinjam` int NOT NULL DEFAULT '0',
  `jumlah_halaman` int NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `slug`, `sampul`, `penulis`, `penerbit`, `tahun_terbit`, `kategori_id`, `stok`, `dipinjam`, `jumlah_halaman`, `deskripsi`, `created_at`, `updated_at`) VALUES
(11, 'Mengenal Tata Surya', 'mengenal-tata-surya', 'default.png', 'Andi Prasetyo', 'Erlangga', 0, 1, 12, 0, 120, 'Penjelasan lengkap mengenai planet, matahari, dan benda langit lainnya.', '2025-05-07 07:15:48', '2025-05-07 07:15:48'),
(12, 'Sejarah Dunia', 'sejarah-dunia', 'default.png', 'Nina Wulandari', 'Tiga Serangkai', 0, 2, 10, 0, 200, 'Membahas peristiwa besar dunia dari masa ke masa.', '2025-05-07 07:15:48', '2025-05-07 07:30:50'),
(13, 'Fisika Dasar', 'fisika-dasar', 'default.png', 'Budi Santosa', 'Gramedia', 0, 3, 8, 0, 150, 'Konsep dasar fisika dengan penjelasan yang mudah dipahami.', '2025-05-07 07:15:48', '2025-05-07 07:15:48'),
(14, 'Biologi untuk Pemula', 'biologi-untuk-pemula', 'default.png', 'Dewi Lestari', 'Intan Pariwara', 0, 4, 14, 0, 130, 'Memahami dasar ilmu biologi secara menyenangkan.', '2025-05-07 07:15:48', '2025-05-07 07:15:48'),
(15, 'Kimia di Sekitar Kita', 'kimia-di-sekitar-kita', 'default.png', 'Rino Pratama', 'Yudhistira', 0, 1, 7, 0, 110, 'Menjelaskan fenomena kimia yang terjadi dalam kehidupan sehari-hari.', '2025-05-07 07:15:48', '2025-05-07 07:15:48'),
(16, 'Ilmu Sosial Modern', 'ilmu-sosial-modern', 'default.png', 'Anisa Rahma', 'Erlangga', 0, 2, 9, 0, 140, 'Analisis ilmu sosial kontemporer dan aplikasinya.', '2025-05-07 07:15:48', '2025-05-07 07:22:07'),
(17, 'Eksperimen Sains Sederhana', 'eksperimen-sains-sederhana', 'default.png', 'Lukman Hakim', 'Tiga Serangkai', 0, 1, 10, 0, 90, 'Panduan melakukan eksperimen IPA dengan bahan sehari-hari.', '2025-05-07 07:15:48', '2025-05-07 07:49:09'),
(18, 'Dunia Mikroorganisme', 'dunia-mikroorganisme', 'default.png', 'Siti Maesaroh', 'Gramedia', 0, 4, 5, 0, 80, 'Mengenal jenis-jenis mikroorganisme dan perannya.', '2025-05-07 07:15:48', '2025-05-07 07:15:48'),
(19, 'Gaya dan Gerak', 'gaya-dan-gerak', 'default.png', 'Ari Kurniawan', 'Yudhistira', 0, 3, 11, 0, 100, 'Konsep gaya dan gerak dalam kehidupan sehari-hari.', '2025-05-07 07:15:48', '2025-05-07 07:15:48'),
(20, 'Peta Dunia', 'peta-dunia', 'default.png', 'Rina Fitriani', 'Intan Pariwara', 0, 2, 10, 0, 105, 'Mempelajari peta dunia dan wilayah-wilayah pentingnya.', '2025-05-07 07:15:48', '2025-05-09 12:10:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit_buku`
--

CREATE TABLE `favorit_buku` (
  `id_favorit` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `favorit_buku`
--

INSERT INTO `favorit_buku` (`id_favorit`, `user_id`, `buku_id`) VALUES
(1, 2, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', '2025-05-07 07:15:42', '2025-05-07 07:15:42'),
(2, 'Non-Fiksi', '2025-05-07 07:15:42', '2025-05-07 07:15:42'),
(3, 'Komik', '2025-05-07 07:15:42', '2025-05-07 07:15:42'),
(4, 'Pendidikan', '2025-05-07 07:15:42', '2025-05-07 07:15:42'),
(5, 'Sejarah', '2025-05-07 07:15:42', '2025-05-07 07:15:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjam` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_kembali` datetime NOT NULL,
  `status` enum('dipinjam','dikembalikan','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `disetujui` enum('pending','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ttd_admin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjam`, `user_id`, `buku_id`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `disetujui`, `ttd_admin`, `created_at`, `updated_at`) VALUES
(3, 2, 17, 5, '2025-05-07 14:34:05', '2025-05-14 14:34:05', 'dikembalikan', 'diterima', '681b0ced8e066.png', '2025-05-07 07:31:03', '2025-05-07 07:49:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_buku`
--

CREATE TABLE `rating_buku` (
  `id_rating` int NOT NULL,
  `user_id` int NOT NULL,
  `buku_id` int NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `rating_buku`
--

INSERT INTO `rating_buku` (`id_rating`, `user_id`, `buku_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 2, 20, 4, '2025-05-07 07:21:40', '2025-05-07 07:21:40'),
(2, 2, 12, 4, '2025-05-07 07:28:43', '2025-05-07 07:28:43'),
(3, 2, 17, 4, '2025-05-08 02:36:33', '2025-05-08 02:36:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `NoHp` varchar(20) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `status_user` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `nisn`, `email`, `NoHp`, `kelas`, `foto_siswa`, `deskripsi`, `status_user`) VALUES
(1, 'Admin', '000000000', 'redmatrixsaga@gmail.com', '085734526342', 'Admin', NULL, 'not ok', '1'),
(2, 'Zahra Putri', '1234567890', 'z@example.com', '081234567899', 'X IPA 1', '', 'Siswa baru di kelas X IPA 1 guys rek', '1'),
(3, 'Faris', '0987654321', 'f@example.com', '082345678901', 'X IPS 2', '', 'Siswa baru di kelas X IPS 2', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `favorit_buku`
--
ALTER TABLE `favorit_buku`
  ADD PRIMARY KEY (`id_favorit`),
  ADD UNIQUE KEY `user_id` (`user_id`,`buku_id`),
  ADD KEY `FBuku` (`buku_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjam`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `rating_buku`
--
ALTER TABLE `rating_buku`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `favorit_buku`
--
ALTER TABLE `favorit_buku`
  MODIFY `id_favorit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rating_buku`
--
ALTER TABLE `rating_buku`
  MODIFY `id_rating` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `favorit_buku`
--
ALTER TABLE `favorit_buku`
  ADD CONSTRAINT `FBuku` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FUser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `rating_buku`
--
ALTER TABLE `rating_buku`
  ADD CONSTRAINT `rating_buku_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `rating_buku_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
