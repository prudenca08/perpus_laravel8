<?php

namespace App\Exports;

use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection,WithHeadings
{
    public function headings():array{
        
        return[
            'No',
            'Kode Transaksi',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Keterangan',
            'Buku ID',
            'Anggota ID',
            'User ID',
            'Created_at',
            'Updated_at'
        ];
    }
    public function collection()
    {
        return Transaksi::get();
    }
}
