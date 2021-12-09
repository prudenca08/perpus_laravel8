<div class="form-group">
    <label>Nama</label>
    <input type="text"   class="form-control" value="{{ $anggota->nama }}">
</div>
<div class="form-group">
    <label>NIM</label>
    <input type="number"   class="form-control" value="{{ $anggota->nim }}">
</div>
<div class="form-group">
    <label>No HP</label>
    <input type="number"  class="form-control" value="{{ $anggota->no_hp }}">
</div>

<div class="form-group">
    <label>Tgl Lahir</label>
    <input type="text"  class="form-control" value="{{ $anggota->tgl_lahir }}">
</div>
<div class="form-group">
    <label>Jurusan</label>
    <input type="text"   class="form-control" value="{{ $anggota->jurusan }}">
</div>
<div class="form-group">
    <label>Jenis Kelamin</label>
   <input type="text" class="form-control" value="{{ $anggota->jenis_kelamin }}">

</div>
<div class="form-group">
    <label>Petugas</label>
   <input type="text" class="form-control " value="{{ $anggota->user->level }}">
</div>

