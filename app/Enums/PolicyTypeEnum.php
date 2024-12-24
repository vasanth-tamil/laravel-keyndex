<?php

namespace App\Enums;

enum PolicyTypeEnum: string {
    case PRIVACY = 'privacy';
    case TERMS = 'terms';
    case REFUND = 'refund';
    case CANCELLATION = 'cancellation';
}
