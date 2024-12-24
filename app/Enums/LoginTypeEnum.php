<?php

namespace App\Enums;

enum LoginTypeEnum: string
{
    case EMAIL = 'email';
    case GOOGLE = 'google';
}
