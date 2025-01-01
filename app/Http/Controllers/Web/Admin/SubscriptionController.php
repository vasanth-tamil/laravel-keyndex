<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request) {
        $subscriptions = SubscriptionHistory::isSubscribed()->paginate(10);
        return view('admin.subscription.index', compact('subscriptions'));
    }

    public function subscription_plan(Request $request) {
        $subscriptionPlans = SubscriptionPlan::where('status', true)->paginate(10);
        return view('admin.subscription.subscription_plan', compact('subscriptionPlans'));
    }
}
