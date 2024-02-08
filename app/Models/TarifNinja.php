<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifNinja extends Model
{
    use HasFactory;
    protected $fillable = ['provinsi', 'kabupaten', 'kecamatan', 'l1_tier_code', 'l2_tier_code'];

    public function scopeProvinsi($query)
    {
        return $query->where('l2_tier_code', null);
    }

    public function scopeKabupaten($query, $l1TierCode)
    {
        return $query->where('l1_tier_code', $l1TierCode)->where('l2_tier_code', '!=', null);
    }
}
