<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;
    public $guard = [];
    protected $fillable = ['nama_widget','url_widget','status_widget'];
    protected $table = 'widget';
}
