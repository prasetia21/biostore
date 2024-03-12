<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNinja extends Model
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

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function guest(){
        return $this->belongsTo(Guest::class,'guest_id','id');
    }
}
