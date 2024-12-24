<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Helpers\Helper;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::active()
                    ->searchEmail($request->email)
                    ->searchByName($request->name)
                    ->paginate(config('api.v1.pagination'));
        return $this->apiResponse(Helper::formatPagination($data), Response::HTTP_OK);
    }

    public function invite(Request $request)
    {
        $filteredEmails = [];

        foreach($request->data as $data) {
            $user = User::where('email', $data)->first();
            if($user) {
                $filteredEmails[] = $user->email;
            }
        }

        $sendedInvites = [];
        foreach($filteredEmails as $email) {
            $sendedInvites[] = Helper::send_invite($email);
        }

        return $this->apiResponse(['message' => 'Invites sent successfully'], Response::HTTP_OK);
    }
}
