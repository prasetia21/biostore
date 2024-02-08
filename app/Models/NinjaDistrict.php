<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NinjaDistrict extends Model
{
    use HasFactory;

    protected $fillable = ['ninja_regency_id', 'name', 'l1_tier_code', 'l2_tier_code'];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
