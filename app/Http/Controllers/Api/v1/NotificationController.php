<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notification;
use App\Helpers\Helper;

class NotificationController extends Controller
{
    public function index(Request $request) {
        $data = Notification::when($request->type, function ($query) use ($request) {
                                if($request->type == 'single') {
                                    $query->where('type', $request->user()->id);
                                }
                                $query->where('type', $request->type);
                            })
                            ->latest()
                            ->paginate(config('api.v1.pagination'));
        return $this->apiResponse(Helper::formatPagination($data), 200);
    }

    public function updateDeviceToken(Request $request) {
        $user = $request->user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return $this->apiResponse([], 200);
    }
}
