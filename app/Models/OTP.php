<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_used',
        'code',
        'expires_at'
    ];
    protected $dates = ['expires_at'];
    protected $casts = [
        'code' => 'string'
    ];

    protected static function booted()
    {
        self::creating(function ($otp) {
            $charecters = "0123456789";
            $charectersLength = strlen($charecters);
            $randomString = "";
            for ($i = 0; $i < config("otp.length"); $i++) {
                $randomString .= $charecters[random_int(0, $charectersLength - 1)];
            }
            $otp->attributes['code'] = $randomString;
            $otp->attributes['expires_at'] =
                now()->addMinutes(intval(config("otp.expiry_minutes")));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($q)
    {
        return $q->where("expires_at", ">=", now())
            ->where("is_used", false);
    }

    public function scopeUsed($q)
    {
        return $q->where("is_used", true);
    }
}
