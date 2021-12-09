<form action="{{ route('transaksi.update',$transaksi->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>NIM Mahasiswa</label>
                    <input type="text" placeholder="masukkan nim" name="nim"class="form-control" autocomplete="off" value="{{ $transaksi->anggota->nim }}">
                    @error('nim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Buku</label>
                    <select name="buku_id" class="form-control">
                        <option disabled selected>-- Pilih Buku --</option>
                        @foreach ($buku as $item)
                        <option value="{{ $item->id }}">{{ $item->judul }}</option>
                        @endforeach
                    </select>
                    @error('buku_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam"class="form-control" value="{{ $transaksi->tgl_pinjam }}">
                    @error('tgl_pinjam')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali"class="form-control" value="{{ $transaksi->tgl_kembali }}">
                    @error('tgl_kembali')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option disabled selected>-- Pilih Status --</option>
                        <option value="pinjam">Pinjam</option>
                        <option value="kembali">Kembali</option>
                    </select>
                </div>
                @if ($transaksi->ket)
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea  name="ket"class="form-control" placeholder="optional" value = {{ $transaksi->ket }}></textarea>
                    </div>    
                @endif
                   
                <div class="float-right">
                   
                    <button type="submit" class="btn btn-primary">update</button>
                </div>
                </form>


