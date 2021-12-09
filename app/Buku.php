<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $guarded = [];
    

    public function transaksi(){

        return $this->hasMany(Transaksi::class);
    }
}
