<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'avatar',
        'f_name',
        'l_name',
        'email',
        'email_verified_at',
        'phone',
        'phone_verified_at',
        'password',
        'is_subscribed',
        'status',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'status' => 'boolean',
        'password' => 'hashed',
        'is_subscribed' => 'boolean',
    ];

    public function scopeActive($query) {
        return $query->where('status', true);
    }
}
