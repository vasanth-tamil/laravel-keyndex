<?php

namespace App\Models;

use App\Enums\PageContentTypeEnum;
use Illuminate\Database\Eloquent\Model;

class keyndexTemplate extends Model
{
    protected $fillable = [
        'title',
        'identifier',
        'structure',
        'default_content',
        'content_type',
        'version',
        'status',
    ];

    protected $casts = [
        'content_type' => PageContentTypeEnum::class,
        'status' => 'boolean',
    ];
}

