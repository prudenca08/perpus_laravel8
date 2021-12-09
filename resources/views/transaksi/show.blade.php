<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-12">
            <div class="card-body">
                <div class="card-text">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama: {{ $transaksi->anggota->nama }}</li>  
                        <li class="list-group-item">Nim : {{ $transaksi->anggota->nim }}</li>  
                        <li class="list-group-item">Jurusan : {{ $transaksi->anggota->jurusan }}</li>  
                        <li class="list-group-item">No HP : {{ $transaksi->anggota->no_hp }}</li>  
                        <li class="list-group-item">Waktu Pinjam : {{ $transaksi->tgl_pinjam }}</li>  
                        <li class="list-group-item">Waktu Kembali : {{ $transaksi->tgl_kembali }}</li>  
                        <li class="list-group-item">Buku : {{ $transaksi->buku->judul }}</li>  
                        @if ($transaksi->buku->gambar)
                        <li class="list-group-item">Gambar : <img src="{{ 'storage/'.  $transaksi->buku->gambar}}" width="80" height="80" ></li> 
                        @endif
                        @if ($transaksi->ket)
                        <li class="list-group-item mt-3">Note : {{ $transaksi->ket }}</li> 
                        @endif
                    </ul>
                </div>
                <div class="card-text text-right"><small class="text-muted">{{  $transaksi->user->name }}</small></div>
            </div>
        </div>
    </div>
</div>
