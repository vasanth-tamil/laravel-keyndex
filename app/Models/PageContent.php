<?php

namespace App\Models;

use App\Enums\PageContentTypeEnum;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'code',
        'name',
        'data',
        'content_type',
        'version',
        'status',
        'pubilshed_at',

        // REFERENCE PAGES
        'page_id',
    ];

    protected $casts = [
        'content_type' => PageContentTypeEnum::class,
        'status' => 'boolean',
    ];
}
