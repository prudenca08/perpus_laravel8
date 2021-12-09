<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;
    
    protected $table = 'transaksi';

    protected $guarded = []; 

    public function anggota(){

        return $this->belongsTo(Anggota::class);
    }

    public function buku(){

        return $this->belongsTo(Buku::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
