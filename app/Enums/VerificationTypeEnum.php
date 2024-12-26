<?php

namespace App\Enums;

enum VerificationTypeEnum: string
{
    case EMAIL = 'email';
    case PHONE = 'phone';
    case BOTH = 'both';
    case OTHER = 'other';
}
