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
