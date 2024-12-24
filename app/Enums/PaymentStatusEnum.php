<?php

namespace App\Enums;

enum PaymentStatusEnum: string {
    case PENDING = 'pending';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}
