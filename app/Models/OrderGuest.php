<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGuest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function province(){
        return $this->belongsTo(RajaProvince::class,'raja_province_id','id');
    }

     public function city(){
        return $this->belongsTo(RajaCity::class,'city_id','id');
    }

    public function guest(){
        return $this->belongsTo(User::class,'guest_id','id');
    }
}
