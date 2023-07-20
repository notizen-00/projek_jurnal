<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'table_menu';

    public function submenu()
    {
        return $this->belongsTo(Submenu::class,'id','menu_id');
    }
}
