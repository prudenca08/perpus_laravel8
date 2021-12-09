<?php

use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaksi::insert([

            [
                'kode_transaksi' => '123456',
                'tgl_pinjam' => '2021-08-22',
                'tgl_kembali' => '2021-11-22',
                'status' => 'pinjam',
                'ket'  => 'buku lily penulis alan walker sedang dipinjam selama 3 hari',
                'anggota_id' => 1,
                'buku_id' => 1,
                'user_id' =>1,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}