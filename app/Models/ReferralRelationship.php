<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralRelationship extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['referral_link_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
