<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Exports\BukuExport;
use App\Exports\TransaksiExport;
use App\Transaksi;

use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function bukuPdf(){

        //set font pdf
        \PDF::setOptions(['dpi' => '150','defaultFont' => 'sans-serif']);

        $buku = Buku::orderBy('judul','asc')->get();

        $pdf = \PDF::loadView('laporan.bukuPdf',compact('buku'));
        // return $pdf->stream('laporan_buku.pdf');
        return $pdf->download('laporan_buku.pdf');
    }

    public function bukuExcel(){

        return \Excel::download(new BukuExport,'laporan_buku.xlsx');
       
    }

    public function transaksiPdf(){

        \PDF::setOptions(['dpi' => '150','defaultFont' => 'sans-serif']);

        $transaksi = Transaksi::with('user','buku','anggota')->orderBy('created_at','desc')->get();

        $pdf = \PDF::loadView('laporan.transaksiPdf',compact('transaksi'));
        // return $pdf->stream('laporan_transaksi.pdf');
        return $pdf->download('laporan_transaksi.pdf');
    }

    public function transaksiExcel(){

        return \Excel::download(new TransaksiExport,'laporan_transaksi.xlsx');
    }
}

