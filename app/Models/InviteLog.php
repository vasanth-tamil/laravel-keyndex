<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteLog extends Model
{
    protected $fillable = [
        'email',
        'token',
        'is_accepted',

        // REFERENCES
        'invited_by',
        'invited',
    ];

    protected $casts = [
        'is_accepted' => 'boolean',
    ];
}
