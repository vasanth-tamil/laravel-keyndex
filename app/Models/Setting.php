<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        'key',
        'value',

        // REFERENCES
        'user_id',
    ];

    protected $casts = [
        'value' => 'json',
    ];
}
