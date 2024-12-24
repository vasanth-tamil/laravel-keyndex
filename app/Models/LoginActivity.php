<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\OperatingSystemEnum;

class LoginActivity extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'logged_in_at',
        'logged_out_at',
        'operating_system',
        'login_type',
        'status',

        // REFERENCES
        'user_id',
    ];

    protected $casts = [
        'operating_system' => OperatingSystemEnum::class,
        'status' => 'boolean',
    ];
}
