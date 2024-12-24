<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\PolicyTypeEnum;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type', // 'privacy', 'terms', 'refund', 'cancellation'
        'status',
    ];

    protected $casts = [
        'type' => PolicyTypeEnum::class,
        'status' => 'boolean',
    ];
}
