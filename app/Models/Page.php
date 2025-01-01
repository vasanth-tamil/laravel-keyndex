<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_desc',
        'keywords',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
