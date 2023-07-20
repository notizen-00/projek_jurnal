<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';

    public function detail_akun()
    {

        return belongsTo(Account::class);
    }
}

