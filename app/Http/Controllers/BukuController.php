<?php

namespace App\Http\Controllers;

use App\Buku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buku.index',[
            'title' => 'Daftar Buku',
            'buku' => Buku::orderBy('penulis','asc')->paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:25|unique:buku',
            'isbn' => 'required|unique:buku',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'jumlah_buku' => 'required',
            'lokasi' => 'required',
            // 'gambar' => 'required|image|mimes:jpg,jpeg,png,svg'
        
        ],[
            'required' => 'atribute tidak boleh kosong',
            'unique' => 'atribute sudah terdaftar',
            'max' => 'karakter max 25',
            'image' => 'atribute harus gambar',
            // 'mimes' => 'atribute harus format jpg,jpeg,png atau svg'
        ]);

        //request file gambar jika ada tambahkan dan jika kosong
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = $file->store('img/buku');
        }
        
        //insert to database buku
       Buku::create([
            'judul' => $request->judul,
            'isbn' => $request->isbn ?? '',
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku,
            'deskripsi' => $request->deskripsi ?? '',
            'lokasi' => $request->lokasi ?? '',
            'gambar' => $fileName ?? '',
            'created_at' => Carbon::now()
        ]);

        //session success 
        return redirect('buku')->with('success','buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('buku.show',compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.edit',compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $buku = Buku::find($id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            Storage::delete($buku->gambar);
            $fileName = $file->store('img/buku');
        }else{
            $fileName = $buku->gambar;
        }

        $buku->update([
            'judul' => $request->judul ?? $buku->judul,
            'isbn' => $request->isbn ?? $buku->isbn,
            'penulis' => $request->penulis ?? $buku->penulis,
            'penerbit' => $request->penerbit ?? $buku->penerbit,
            'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
            'jumlah_buku' => $request->jumlah_buku ?? $buku->jumlah_buku,
            'lokasi' => $request->lokasi ?? $buku->lokasi,
            'gambar' => $fileName ?? $request->file('gambar'),
            'updated_at' => Carbon::now()
        ]);
        return redirect('buku')->with('success','buku berhasil diupate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        Storage::delete($buku->gambar);
        $buku->delete();
        return redirect('buku')->with('success','data berhasil dihapus');

    }

    // pencarian
    public function search(Request $request){

        $request->validate([
            'q' => 'required'
        ],[
            'required' => 'atribute tidak boleh kosong'
        ]);
        $cari = $request->q;
        $buku = Buku::where('judul','LIKE',"%$cari%")->orWhere('penulis','LIKE',"%$cari%")->paginate();

        return view('buku.index',[
            'title' => 'Daftar Buku',
            'buku' => $buku
        ]);
    }
}
