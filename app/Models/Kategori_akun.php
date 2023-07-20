<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_akun extends Model
{
    use HasFactory;
    protected $table="kategori_akun";

   public function account()
   {

    return $this->belongsTo(Account::class);
   }
}
