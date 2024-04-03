<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function province(){
        return $this->belongsTo(NinjaProvince::class,'ninja_province_id','id');
    }

     public function city(){
        return $this->belongsTo(NinjaRegency::class,'ninja_regency_id','id');
    }

    public function district(){
        return $this->belongsTo(NinjaDistrict::class,'ninja_district_id','id');
    }
}
