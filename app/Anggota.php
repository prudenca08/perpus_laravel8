<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $guarded = [];

    public function user(){

       return $this->belongsTo(User::class);
    }

    public function transaksi(){

        return $this->hasMany(Transaksi::class);
    }
}
