<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;
    protected $table="table_submenu";

    public function detail_menu()
    {
        return $this->belongsTo(Menu::class,'id','menu_id');
    }
}
