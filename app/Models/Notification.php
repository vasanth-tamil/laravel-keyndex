<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\NotificationTypeEnum;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'message',
        'status',
        'type',

        'target_id' // ONLY USED FOR SINGLE NOTIFICATION
    ];

    protected $casts = [
        'status' => 'boolean',
        'type' => NotificationTypeEnum::class,
    ];
}
