<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

use App\Enums\PaymentMethodEnum;

use App\Helpers\Helper;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionPlan;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptionPlans = SubscriptionPlan::where('status', true)->get();
        $histories = SubscriptionHistory::where('subscriber_id', $request->user()->id)->latest()->paginate(config('api.v1.pagination'));
        $data = Helper::formatPagination($histories);
        $data['subscription_plans'] = $subscriptionPlans;

        return $this->apiResponse($data, Response::HTTP_OK);
    }

    public function subscribe(Request $request, $id)
    {
        // CHECK SUBSCRIPTION ON MONTHLY PLAN OR YEARLY CHECK
        $subscriptionPlan = SubscriptionPlan::findOrFail($id);

        $paymentRef = null;
        $paymentMethod = null;

        if($subscriptionPlan->price != 0) {
            $validatedData = $request->validate([
                'payment_ref' => 'required|string',
                'payment_method' => ['required', new Enum(PaymentMethodEnum::class)],
            ]);

            $paymentRef = $request->payment_ref;
            $paymentMethod = $request->payment_method;
        }

        // CHECK ONLINE PAYMENT METHOD
        $isSubcribed = true;

        $data = SubscriptionHistory::create([
            'code' => Helper::generateCode($subscriptionPlan->plan_name, $request->payment_method),
            'price' => $subscriptionPlan->price,
            'payment_ref' => $paymentRef,
            'payment_method' => $paymentMethod,
            'subscribed_at' => now(),
            'expires_at' => now()->addDays($subscriptionPlan->duration),
            'subscription_plan_id' => $subscriptionPlan->id,
            'subscriber_id' => $request->user()->id
        ]);

        $request->user()->update([
            'is_subscribed' => $isSubcribed
        ]);

        return $this->apiResponse($data, Response::HTTP_OK);
    }

    public function upgrade(Request $request, $id)
    {
        $subscriptionPlan = SubscriptionPlan::findOrFail($id);

        if($subscriptionPlan->price != 0) {
            $validatedData = $request->validate([
                'payment_ref' => 'required|string',
                'payment_method' => ['required', new Enum(PaymentMethodEnum::class)],
            ]);
        }


        $data = SubscriptionHistory::create([
            'code' => Helper::generateCode($subscriptionPlan->plan_name, $request->payment_method),
            'price' => $subscriptionPlan->price,
            'payment_ref' => $request->payment_ref,
            'payment_method' => $request->payment_method,
            'subscription_plan_id' => $subscriptionPlan->id,
            'subscriber_id' => $request->user()->id
        ]);

        return $this->apiResponse($data, Response::HTTP_OK);
    }

    // SHOW SUBSCRIPTIONHISTORY
    public function show_subscription($id) {
        $data = SubscriptionHistory::with('subscriptionPlan')->findOrFail($id);
        return $this->apiResponse($data, Response::HTTP_OK);
    }

    // SHOW SUBSCRIPTIONPLAN
    public function show($id)
    {
        $data = SubscriptionPlan::findOrFail($id);
        return $this->apiResponse($data, Response::HTTP_OK);
    }
}
