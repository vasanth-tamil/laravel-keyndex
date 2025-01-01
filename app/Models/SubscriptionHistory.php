<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;

class SubscriptionHistory extends Model
{
    protected $fillable = [
        'code',
        'price',
        'payment_ref',
        'payment_method',
        'status',
        'subscribed_at',
        'expires_at',

        // REFERENCES
        'subscription_plan_id',
        'subscriber_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'payment_method' => PaymentMethodEnum::class,
        'status' => PaymentStatusEnum::class,
    ];

    public function scopeIsPlanActive($query) {
        return $query->where('status', PaymentStatusEnum::PAID)
                     ->where('expires_at', '>', now());
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function scopeIsSubscribed($query)
    {
        return $query->where('status', PaymentStatusEnum::PAID)
            ->where('expires_at', '>', now());
    }

    public function subscriber()
    {
        return $this->belongsTo(User::class);
    }
}
