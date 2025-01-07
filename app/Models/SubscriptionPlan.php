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

    protected $appends = ['is_current_plan'];

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class);
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', true);
    }

    public function getIsCurrentPlanAttribute()
    {
        return auth()->user()->subscription_plan_id == $this->id;
    }
}
