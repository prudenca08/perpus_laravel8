<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>Laporan Buku</title>
    <style>
        .text-center{
            text-align: center;
        }
        .container{
           
        }
        .text-right{
            text-align: right;
        }
        .mb{
            margin-bottom: 10px;
        }
        .page-break{
            page-break-after: always;
        }
        
        .pagenum:before{
                content: counter(page);
        }
    
    </style>
</head>
<body>
    <h4 class="text-center">Laporan Buku</h4>
    <div class="text-right mb">
        
        <span>Tanggal : {{ date('d-M-Y') }}</span>/
        <span>Jam : {{ date('H:i') }}</span><br>
        Halaman: <span class="pagenum"></span>

    </div>
   
    <div class="container">
        <table border="1" cellspacing="0" cellpadding="15">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Rak</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($buku as $item) 
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>{{ $item->jumlah_buku }}</td>
                    <td>{{ $item->lokasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Petugas: {{ Auth::user()->level }}</p>
        <span></span>
    </div>
 
</body>
</html>