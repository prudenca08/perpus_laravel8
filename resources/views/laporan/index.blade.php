@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col">
                        <h3 class="mb-0">Laporan Anggota & Transaksi </h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="card-text mb-2"><i class="ni ni-book-bookmark"></i> Buku</div>
                            <section class="buku">
                                <a class="btn btn-danger " href="{{ route('buku.pdf') }}" target="_blank"><i class="ni ni-cloud-download-95"></i> Export Pdf</a>
                                <a class="btn btn-success" href="{{ route('buku.excel') }}" target="_blank">
                                 <i class="ni ni-cloud-download-95"></i> Export Excel</a>
                            </section>
                          </div>
                       <div class="col-md-6 text-right">
                            <div class="card-text mb-2 ">Transaksi <i class="ni ni-ruler-pencil"></i></div>
                                <section class="transaksi">
                                    <a class="btn btn-danger " href="{{ route('transaksi.pdf') }}" target="_blank"><i class="ni ni-cloud-download-95"></i> Export Pdf</a>
                                    <a class="btn btn-success " href="{{ route('transaksi.excel') }}"><i class="ni ni-cloud-download-95"></i>  Export Excel</a>
                                </section>
                            </div>
                       </div>
                      </div>
                </div>
              </div>
        </div>
    </div>
@endsection