<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NinjaProvince extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }
}