<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case Stripe = 'stripe';
    case Razorpay = 'razorpay';
}
