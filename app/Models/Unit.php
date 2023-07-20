<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public $guarded= [];
    protected $table="unit_produk";

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
