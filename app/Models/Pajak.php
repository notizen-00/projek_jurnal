<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;
    protected $table = 'pajak';

    public function scopeWithDataAccount($query,$kode_akun)
    {
        $data_akun = $query->where('kode_akun',$kode_akun)->get('account');

        return $data_akun;

    }
}
