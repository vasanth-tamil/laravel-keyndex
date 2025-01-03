<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Enums\PolicyTypeEnum;

use App\Models\Policy;

class AppController extends Controller
{
    public function config(Request $request) {
        $data = [
            "mantanece" => false,
            "file_upload" => env('APP_URL') . '/uploads',
        ];

        return $this->apiResponse($data, 200);
    }


    public function save_settings(Request $request)
    {
        $validateData = $request->validate([
            "theme" => "required|array",
            "theme.dark" => "required|boolean",

            "secure_access" => "required|array",
            "secure_access.enable" => "required|boolean",
            "secure_access.methods" => "required|array",
            "secure_access.methods.email" => "required|boolean",
            "secure_access.methods.sms" => "required|boolean",

            "notifications" => "required|array",
            "notifications.sms" => "required|boolean",
            "notifications.email" => "required|boolean",
            "notifications.push" => "required|boolean",
        ]);

        $data = Setting::firstOrCreate([
            "key" => "mobile_settings",
            "user_id" => $request->user()->id,
        ], [
            "value" => $validateData,
        ]);
        return $this->apiResponse($data, Response::HTTP_OK);
    }


    public function search(Request $request) {
        return $this->apiResponse([], Response::HTTP_OK);
    }

    public function home(Request $request) {
        $data = [];

        return $this->apiResponse($data, Response::HTTP_OK);
    }


    public function policy(Request $request, $type='privacy') {
        $policyTypeEnum = PolicyTypeEnum::tryFrom($type);

        if($policyTypeEnum) {
            $data = Policy::where('type', $policyTypeEnum->value)->first();
            if($data) {
                return $this->apiResponse($data, Response::HTTP_OK);
            }
        }

        return $this->apiResponse([], Response::HTTP_NOT_FOUND);
    }
}
