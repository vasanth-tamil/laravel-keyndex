<?php

namespace App\Enums;

enum PageContentTypeEnum: string
{
    case JSON = 'json';
    case HTML = 'html';
    case MARKDOWN = 'markdwon';
}
