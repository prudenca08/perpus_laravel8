@extends('layouts.master')
@section('content')
    <div class="row ">
        <div class="col-md-6 mt-4 mb-2">
            <a class="btn btn-secondary btn-rounded" data-toggle="modal" data-target="#tambahBuku"> Tambah Buku</a>
        </div>
        <div class="col-md-6 mt-4 mb-3 d-flex justify-content-end">
              <!-- Search form -->
              <form  action="{{ route('buku.search') }}" method="get" class="navbar-search navbar-search-light form-inline mr-sm-3 " id="navbar-search-main">

                <input type="text" placeholder="masukkan pencarian" class="form-control bg-white @error('q') is-invalid @enderror" name="q" autocomplete="off" autofocus>
               <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
    
            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="my-3 text-center">{{ $title }}</h3>
                    <div class="success" data-flash="{{ session()->get('success') }}"></div>
                    <div class="hapus" data-flash="{{ session()->get('success') }}"></div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="Judul">Judul</th>
                                <th scope="col" class="sort" data-sort="Penulis">Penulis</th>
                                <th scope="col" class="sort" data-sort="Penerbit">Penerbit</th>
                                <th scope="col" class="sort" data-sort="Tahun Terbit">Tahun Terbit</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($buku as $item)

                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{ $item->judul }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget">
                                        {{ $item->penulis }}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-warning"></i>
                                            <span class="status">{{ $item->penerbit }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        {{ $item->tahun_terbit }}
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <button class="dropdown-item btn-detail" data-target="#detailBuku" data-toggle="modal" data-id="{{ $item->id }}" >Detail</button>

                                                <button class="dropdown-item btn-edit" data-toggle="modal" data-target="#editBuku" data-id="{{ $item->id }}">Edit</button>
                            
                                                <form action="{{ route('buku.destroy', $item->id) }}" method="post"
                                                    id="delete{{ $item->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item" type="button"
                                                        onclick="deleteBuku({{ $item->id}})">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{-- pagination --}}
                        @if ($buku->lastPage() != 1)
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $buku->previousPageUrl() }}" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $buku->lastPage(); $i++)
                                    <li class="page-item {{ $i == $buku->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $buku->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $buku->nextPageUrl() }}">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        @endif

                        @if (count($buku) == 0)
                            <div class="text-center"> Tidak ada data!</div>
                        @endif

                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')

     {{-- Modal Tambah Buku --}}
     <div class="modal fade" id="tambahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  mt-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="form-control">
                            @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">ISBN</label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}" class="form-control">
                            @error('isbn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input type="text" name="penulis" value="{{ old('penulis') }}" class="form-control">
                            @error('penulis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="form-control">
                            @error('penerbit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Terbit</label>
                            <input type="number" min="0" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="form-control">
                            @error('tahun_terbit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" min="0" name="jumlah_buku" value="{{ old('jumlah_buku') }}" class="form-control">
                            @error('jumlah_buku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" value="{{ old('deskripsi') }}" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi</label>
                           <select name="lokasi" class="form-control">
                               <option value="" disabled selected>-- Pilih Rak --</option>
                               <option value="rak1">Rak 1</option>
                               <option value="rak2">Rak 2</option>
                               <option value="rak3">Rak 3</option>
                           </select>
                           @error('lokasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
    
                            <img width="150" height="150" />
                            <input type="file" name="gambar" id="" class="uploads form-control mt-2" value="{{ old('gambar') }}">
                            @error('gambar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary ">simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    {{-- Modal Detail Buku  --}}
    <div class="modal fade" id="detailBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
     </div>

        {{-- Modal Edit Buku  --}}
    <div class="modal fade" id="editBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  mt-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
     </div>



@endsection

@push('script')
    <script>


        //show gambar
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                return false
            })
        })

        //delete buku
        function deleteBuku(id) {
            
            Swal.fire({
                title: 'PERINGATAN!',
                text: "Yakin ingin menghapus Buku?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancle',
            }).then((result) => {
                if (result.value) {
                    $('#delete' + id).submit();
                }
            })
        }

        $(document).ready(function(){

            //detail buku
            $('.btn-detail').on('click',function(){
                let id = $(this).data('id');
                
                $.ajax({
                    url:`http://localhost:8000/buku/${id}`,
                    method:'GET',
                    success:function(data){
                        $('#detailBuku').find('.modal-body').html(data);
                        $('#detailBuku').show();
                    }
                })
            })

             //edit buku
             $('.btn-edit').on('click',function(){
                let id = $(this).data('id');
                
                $.ajax({
                    url:`http://localhost:8000/buku/${id}/edit`,
                    method:'GET',
                    success:function(data){
                        $('#editBuku').find('.modal-body').html(data);
                        $('#editBuku').show();
                    }
                })
            })
            //session flash success 
            let success = $('.success').data('flash');
            if (success) {
                Swal.fire({
                    
                    position: 'center',
                    type: 'success',
                    title: success,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            //session flash hapus 
            let hapus = $('.hapus').data('flash');
            if (hapus) {
                Swal.fire({
                    
                    position: 'center',
                    type: 'success',
                    title: hapus,
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        })
    </script>
@endpush
