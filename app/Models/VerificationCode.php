<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\VerificationTypeEnum;

class VerificationCode extends Model
{
    public $fillable = [
        'code',
        'type', // 'email', 'phone', 'both', 'other'
        'is_used',
        'expires_at',

        // REFERENCES
        'user_id'
    ];

    protected $casts = [
        'type' => VerificationTypeEnum::class,
    ];

    public static function dailyOtpCount($userId, $type)
    {
        return self::where('user_id', $userId)
                    ->where('type', $type)
                    ->where('is_used', false)
                    ->whereDate('created_at', now()->toDateString()) // Filter for today's date
                    ->count();
    }


    public function scopeUnusedEmailCode($query, $userId, $otp) {
        return $query->where([
            'user_id' => $userId,
            'code' => $otp,
            'type' => VerificationTypeEnum::EMAIL->value,
            'is_used' => false,
        ]);
    }

    public function scopeIsExpired($query) {
        return now()->isAfter($this->expires_at);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
