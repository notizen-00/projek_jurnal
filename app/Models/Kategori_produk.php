<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_produk extends Model
{
    use HasFactory;
    protected $table = "kategori_produk";

    public function produk()
    {

        return $this->belongsTo(Product::class);
    }
}
