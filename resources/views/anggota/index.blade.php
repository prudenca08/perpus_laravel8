@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-6 mt-4 mb-2">
                        <a class="btn btn-secondary btn-rounded" data-toggle="modal" data-target="#tambahAnggota"> Tambah Anggota</a>
                    </div>
                    <div class="col-md-6 mt-4 mb-3 d-flex justify-content-end">
                        <!-- Search form -->
                        <form  action="{{ route('anggota.search') }}" method="get" class="navbar-search navbar-search-light form-inline mr-sm-3 " id="navbar-search-main">
          
                          <input type="text" placeholder="masukkan pencarian" class="form-control bg-white" name="q" id="q">
                         <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
              
                      </form>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0">
                                <h3 class="my-3 text-center">{{ $title }}</h3>
                                <div class="success" data-flash="{{ session()->get('success') }}"></div>

                            </div>
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="Judul">Nama</th>
                                            <th scope="col" class="sort" data-sort="Penulis">NIM</th>
                                            <th scope="col" class="sort" data-sort="Penerbit">Jenis Kelamin</th>
                                            <th scope="col" class="sort" data-sort="Tahun Terbit">Jurusan</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($anggota as $item)
                                            
                                        <tr>
                                            <th scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="name mb-0 text-sm">{{ $item->nama }}</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="budget">
                                                  {{ $item->nim }}
                                                </td>
                                                <td>
                                                    @if ($item->jenis_kelamin == 'pria')
                                                        <span class="badge badge-dot mr-4">
                                                            <i class="bg-primary"></i>
                                                            <span class="status">{{ $item->jenis_kelamin }}</span>
                                                        </span>
                                                    @else 
                                                        <span class="badge badge-dot mr-4">
                                                            <i class="bg-danger"></i>
                                                            <span class="status">{{ $item->jenis_kelamin }}</span>
                                                        </span>
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    {{ $item->jurusan }}
                                                </td>
                    
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <button class="dropdown-item btn-detail" data-target="#detailAnggota" data-toggle="modal" data-id="{{ $item->id }}">Detail</button>
                                                            
                                                            <button class="dropdown-item btn-edit" data-toggle="modal" data-target="#editAnggota" data-id="{{ $item->id }}">Edit</button>
                                        
                                                            <form action="{{ route('anggota.destroy',$item->id) }}" method="post" id="delete{{ $item->id }}">
                                                                @csrf
                                                                @method('delete')
                                                            <button class="dropdown-item" type="button" onclick="deleteAnggota({{ $item->id }})">Hapus</button>
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
                                    
                                    @if ($anggota->lastPage() != 1)
                                    <ul class="pagination justify-content-end mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="{{ $anggota->previousPageUrl() }}" tabindex="-1">
                                                    <i class="fas fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $anggota->lastPage(); $i++)
                                            <li class="page-item {{ $i == $anggota->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $anggota->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $anggota->nextPageUrl() }}">
                                                    <i class="fas fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                    </ul> 
                                    @endif
                                    @if (count($anggota) == 0)     
                                        <div class="text-center" colspan="4"> Tidak ada data!</div>    
                                    @endif       
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       
@endsection


@section('modal')
     {{-- Modal add Anggota  --}}
     <div class="modal fade" id="tambahAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mt-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('anggota.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama"  class="form-control" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="">Nim</label>
                            <input type="text"  name="nim"  class="form-control" value="{{ old('nim') }}" autocomplete="off">
                            @error('nim')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">No HP</label>
                            <input type="number" min="0" name="no_hp"  class="form-control" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir"  class="form-control" value="{{ old('tgl_lahir') }}">
                            @error('tgl_lahir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jurusan</label>
                            <input type="text" name="jurusan"  class="form-control" value="{{ old('jurusan') }}">
                            @error('jurusan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option disabled selected>-- Pilih Jenis Kelamin -- </option>
                               
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                
                            </select>
                            @error('jenis_kelamin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Petugas</label>
                            <select name="user_id" class="form-control">
                                <option disabled selected>-- Pilih Petugas --</option>
                                @foreach ($users as $item)
                                <option value="{{ $item->id }}"> {{  $item->level }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>


     {{-- Modal Detail Anggota  --}}
     <div class="modal fade" id="detailAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                </div>
            </div>
        </div>
     </div>
     {{-- Modal Edit Anggota  --}}
     <div class="modal fade" id="editAnggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  mt-5">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                   
                </div>
            </div>
        </div>
     </div>
@endsection

@push('script')
    <script>


        //delete anggota
        function deleteAnggota(id){
            Swal.fire({
                title: 'PERINGATAN!',
                text: "Yakin ingin menghapus Anggota?",
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

            //detail anggota
            $('.btn-detail').click(function(){

                let id = $(this).data('id');
                $.ajax({
                    url : `http://localhost:8000/anggota/${id}`,
                    method:'GET',
                    success:function(data){
                        $('#detailAnggota').find('.modal-body').html(data);
                        $('#detailAnggota').show();
                    
                    }
                })
            })

            //edit anggota
            $('.btn-edit').click(function(){

                let id = $(this).data('id');
                $.ajax({
                    url : `http://localhost:8000/anggota/${id}/edit`,
                    method : 'GET',
                    success: function(data){

                        $('#editAnggota').find('.modal-body').html(data);
                        $('#editAnggota').show();
                        $('#loader').show();
                    }
                })
            })
            // session delete anggota 
            let success = $('.success').data('flash');
            if(success){
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: success,
                    showConfirmButton: false,
                    timer: 2000
                })
            }

            //cari anggota
            let route = "{{ route('anggota.search') }}" 
       

        })
    </script>
@endpush