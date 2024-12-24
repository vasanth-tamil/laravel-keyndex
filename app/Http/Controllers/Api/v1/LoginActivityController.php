<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Helpers\Helper;
use App\Models\LoginActivity;

class LoginActivityController extends Controller
{
    public function index(Request $request)
    {
        $data = LoginActivity::paginate(config('api.v1.pagination'));
        return $this->apiResponse(Helper::formatPagination($data), Response::HTTP_OK);
    }

    public function show(Request $request, $id)
    {
        $data = LoginActivity::findOrFail($id);
        return $this->apiResponse($data, Response::HTTP_OK);
    }

    public function logout_device(Request $request, $id)
    {
        $currentLogin = LoginActivity::findOrFail($id);
        $currentLogin->update([
            'logged_out_at' => date('Y-m-d H:i:s')
        ]);

        $data = [
            'ip_address' => $currentLogin->ip_address,
            'user_agent' => $currentLogin->user_agent,
            'logged_out_at' => $currentLogin->logged_out_at
        ];
        return $this->apiResponse($data, Response::HTTP_OK);
    }
}
