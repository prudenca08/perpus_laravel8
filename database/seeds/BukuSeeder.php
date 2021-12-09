<?php

use App\Buku;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::insert([
            [
                'judul' => 'Naruto Shippuden',
                'isbn' => '9983742831',
                'penulis' => 'Masashi Kisimoto',
                'penerbit' => 'Shonen Jump',
                'tahun_terbit' => '1995',
                'jumlah_buku' => '8',
                'lokasi' => 'rak1',
                'gambar' => 'naruto.jpg',
                'created_at' => Carbon::now()
            ],
            [
                'judul' => 'One Piece',
                'isbn' => '9983723423',
                'penulis' => 'Eichiiro Oda',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => '1994',
                'jumlah_buku' => '10',
                'lokasi' => 'rak2',
                'gambar' => 'onepiece.jpg',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
