<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class BookSeeder extends Seeder
{
    public function run()
    {
        // $faker = \Faker\Factory::create('id_ID');

        // for ($i = 0; $i < 100; $i++) {
        //     $judul = $faker->sentence(3);
        //     $slug = url_title($judul, '-', true);
        //     $data = [
        //         'judul_buku' => $faker->words(3, true),
        //         'slug'            => $slug,
        //         'sampul'          => 'default.png',
        //         'penulis'         => $faker->name,
        //         'penerbit'        => $faker->company,
        //         'stok'            => $faker->numberBetween(1, 100),
        //         'jumlah_halaman'  => $faker->numberBetween(50, 500),
        //         'deskripsi'  => $faker->sentence(8),
        //         'kategori_id'     => $faker->numberBetween(1, 4), // Kategori 1-4
        //     ];

        //     $this->db->table('buku')->insert($data);
        // }

        $data = [
            [
                'judul_buku' => 'Mengenal Tata Surya',
                'slug' => 'mengenal-tata-surya',
                'sampul' => 'default.png',
                'penulis' => 'Andi Prasetyo',
                'penerbit' => 'Erlangga',
                'stok' => 12,
                'jumlah_halaman' => 120,
                'deskripsi' => 'Penjelasan lengkap mengenai planet, matahari, dan benda langit lainnya.',
                'kategori_id' => 1
            ],
            [
                'judul_buku' => 'Sejarah Dunia',
                'slug' => 'sejarah-dunia',
                'sampul' => 'default.png',
                'penulis' => 'Nina Wulandari',
                'penerbit' => 'Tiga Serangkai',
                'stok' => 10,
                'jumlah_halaman' => 200,
                'deskripsi' => 'Membahas peristiwa besar dunia dari masa ke masa.',
                'kategori_id' => 2
            ],
            [
                'judul_buku' => 'Fisika Dasar',
                'slug' => 'fisika-dasar',
                'sampul' => 'default.png',
                'penulis' => 'Budi Santosa',
                'penerbit' => 'Gramedia',
                'stok' => 8,
                'jumlah_halaman' => 150,
                'deskripsi' => 'Konsep dasar fisika dengan penjelasan yang mudah dipahami.',
                'kategori_id' => 3
            ],
            [
                'judul_buku' => 'Biologi untuk Pemula',
                'slug' => 'biologi-untuk-pemula',
                'sampul' => 'default.png',
                'penulis' => 'Dewi Lestari',
                'penerbit' => 'Intan Pariwara',
                'stok' => 14,
                'jumlah_halaman' => 130,
                'deskripsi' => 'Memahami dasar ilmu biologi secara menyenangkan.',
                'kategori_id' => 4
            ],
            [
                'judul_buku' => 'Kimia di Sekitar Kita',
                'slug' => 'kimia-di-sekitar-kita',
                'sampul' => 'default.png',
                'penulis' => 'Rino Pratama',
                'penerbit' => 'Yudhistira',
                'stok' => 7,
                'jumlah_halaman' => 110,
                'deskripsi' => 'Menjelaskan fenomena kimia yang terjadi dalam kehidupan sehari-hari.',
                'kategori_id' => 1
            ],
            [
                'judul_buku' => 'Ilmu Sosial Modern',
                'slug' => 'ilmu-sosial-modern',
                'sampul' => 'default.png',
                'penulis' => 'Anisa Rahma',
                'penerbit' => 'Erlangga',
                'stok' => 9,
                'jumlah_halaman' => 140,
                'deskripsi' => 'Analisis ilmu sosial kontemporer dan aplikasinya.',
                'kategori_id' => 2
            ],
            [
                'judul_buku' => 'Eksperimen Sains Sederhana',
                'slug' => 'eksperimen-sains-sederhana',
                'sampul' => 'default.png',
                'penulis' => 'Lukman Hakim',
                'penerbit' => 'Tiga Serangkai',
                'stok' => 10,
                'jumlah_halaman' => 90,
                'deskripsi' => 'Panduan melakukan eksperimen IPA dengan bahan sehari-hari.',
                'kategori_id' => 1
            ],
            [
                'judul_buku' => 'Dunia Mikroorganisme',
                'slug' => 'dunia-mikroorganisme',
                'sampul' => 'default.png',
                'penulis' => 'Siti Maesaroh',
                'penerbit' => 'Gramedia',
                'stok' => 5,
                'jumlah_halaman' => 80,
                'deskripsi' => 'Mengenal jenis-jenis mikroorganisme dan perannya.',
                'kategori_id' => 4
            ],
            [
                'judul_buku' => 'Gaya dan Gerak',
                'slug' => 'gaya-dan-gerak',
                'sampul' => 'default.png',
                'penulis' => 'Ari Kurniawan',
                'penerbit' => 'Yudhistira',
                'stok' => 11,
                'jumlah_halaman' => 100,
                'deskripsi' => 'Konsep gaya dan gerak dalam kehidupan sehari-hari.',
                'kategori_id' => 3
            ],
            [
                'judul_buku' => 'Peta Dunia',
                'slug' => 'peta-dunia',
                'sampul' => 'default.png',
                'penulis' => 'Rina Fitriani',
                'penerbit' => 'Intan Pariwara',
                'stok' => 13,
                'jumlah_halaman' => 105,
                'deskripsi' => 'Mempelajari peta dunia dan wilayah-wilayah pentingnya.',
                'kategori_id' => 2
            ],
            // lanjutkan dari index 10 hingga 29
        ];
        
        $this->db->table('buku')->insertBatch($data);
        
    }
}
