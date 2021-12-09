
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            @if ($buku->gambar)
                <img width="150" height="150" @if($buku->gambar) src="{{ asset('Storage/'.$buku->gambar) }}" @endif />
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card-text">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> {{ $buku->judul }}</li>  
                        <li class="list-group-item">Penerbit : {{ $buku->penerbit }}</li>  
                        <li class="list-group-item">Tahun : {{ $buku->tahun_terbit }}</li>  
                        <li class="list-group-item">Stok : {{ $buku->jumlah_buku }}</li>  
                    </ul>
                </div>
                <div class="card-text text-right"><small class="text-muted">{{  $buku->penulis }}</small></div>
            </div>
        </div>
    </div>
</div>

<script>
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

</script>