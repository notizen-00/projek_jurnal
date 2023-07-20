<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    public $guard = [];
    protected $table="penjualan";
    public function kontak()
    {

        return $this->hasOne(Kontak::class,'id','kontak_id');
    }

}
