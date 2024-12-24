<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'plan_name',
        'features',
        'price',
        'days',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'features' => 'json',
    ];

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class);
    }
}
