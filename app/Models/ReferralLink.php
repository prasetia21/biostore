<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLink extends Model
{
    use HasFactory;
    // protected $fillable = ['user_id', 'referral_program_id'];
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (ReferralLink $model) {
            $model->generateCode();
        });
    }

    private function generateCode()
    {
        $this->code = (string) Uuid::uuid1();
    }

    public static function getReferral($user, $program)
    {
        return static::firstOrCreate(
            ['user_id' => $user->id],
            ['referral_program_id' => $program->id]
        );

    }

    public function getLinkAttribute()
    {
        return url($this->program->uri) . '?ref=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        // TODO: Check if second argument is required
        return $this->belongsTo(ReferralProgram::class, 'referral_program_id');
    }

    public function poins()
    {
        return $this->hasMany(ReferralPoin::class);
    }

}