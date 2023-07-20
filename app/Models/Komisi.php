<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\KomisiServices;
class Komisi extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $table='komisi_penjualan';

    public function scopeGetIdActive($query)
    {
        
        $data = $query->where('status',1)->first();
        return $data->id;
        
    }

    public function scopeGetDetailById(KomisiService $service,$id)
    {

       $data = $service->getDataDetail($id);
       return $data;
    }


    public function scopeGetDataRules($query,$id,$rules)
    {   

        $data = $query->selectRaw("{$rules} AS value")->where('id', $id)->first();

        if ($data) {
            return unserialize($data->value);
        }
    
        return null;
    }

   

    


    
}
