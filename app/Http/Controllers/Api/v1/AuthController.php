<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Enums\LoginTypeEnum;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\LoginActivity;

class AuthController extends Controller
{
    public function sign_up(Request $request)
    {
        $validateData = $request->validate([
            "f_name" => "required",
            "l_name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "re_password" => "required:same:password",
        ]);

        // CREATE USER
        $user = User::create($validateData);

        // CREATE TOKEN
        $authToken = $user->createToken($user->f_name . '-access-token')->plainTextToken;

        $data = [
            'access_token' => $authToken,
            'user' => $user
        ];
        return $this->apiResponse($data, Response::HTTP_CREATED);
    }

    public function sign_in(Request $request)
    {
        $validateData = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        // AUTHENTICATION CHECK
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::find(Auth::id());
            $authToken = $user->createToken($user->f_name . '-access-token')->plainTextToken;

            // CREATE LOGIN SESSION
            LoginActivity::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent', 'unknown'),
                'login_type' => LoginTypeEnum::EMAIL,
                'login_in_at' => now(),
                'operating_system' => Helper::getOperatingSystem($request->header('User-Agent', 'unknown')),
                'status' => true,

                'user_id' => $user->id,
            ]);

            return $this->apiResponse(['access_token' => $authToken, 'user' => $user], Response::HTTP_OK);
        }

        // INVALID CREDENTIALS
        return $this->apiResponse(['error' => 'wrong credentials. check and try again.'], Response::HTTP_UNAUTHORIZED);
    }

    public function verify_token(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->token);
        if ($token != null) {
            return $this->apiResponse(['authenticated' => true], Response::HTTP_OK);
        }
        return $this->apiResponse(['authenticated' => false], Response::HTTP_UNAUTHORIZED);
    }

    public function sign_out(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiResponse(['message' => 'logout successfully'], Response::HTTP_OK);
    }

    public function profile(Request $request)
    {
        $user = User::find($request->user()->id);
        return $this->apiResponse($user, Response::HTTP_OK);
    }

    public function update_profile(Request $request)
    {
        $user = User::find($request->user()->id);

        if ($user->exists()) {
            // FILE UPLOAD
            $fileName = $request->avatar ? Helper::uploadFile($request->avatar, 'users') : $user->avatar;

            $user->f_name = $request->f_name ?? $user->f_name;
            $user->l_name = $request->l_name ?? $user->l_name;
            $user->email = $request->email ?? $user->email;
            $user->phone = $request->phone ?? $user->phone;
            $user->avatar = $fileName;
            $user->save();

            return $this->apiResponse($user, Response::HTTP_OK);
        }
        return $this->apiResponse([], Response::HTTP_NOT_FOUND);
    }

    public function change_password(Request $request)
    {
        $user = User::find($request->user()->id);

        if ($user->exists()) {
            $validateData = $request->validate([
                "old_password" => "required",
                "new_password" => "required",
                "re_password" => "required|same:new_password",
            ]);
            // CHECK OLD PASSWORD
            if (!Hash::check($request->old_password, $user->password)) {
                return $this->apiResponse(['errors' => 'current password does not match.'], Response::HTTP_BAD_REQUEST);
            }

            // UPDATE PASSWORD
            $user->password = $request->new_password;
            $user->save();
            return $this->apiResponse($user, Response::HTTP_OK);
        }
        // INVALID USER
        return $this->apiResponse([], Response::HTTP_NOT_FOUND);
    }

    public function forget_password(Request $request)
    {
        $validateData = $request->validate([
            "email" => "required|email|exists:users,email",
        ]);

        $user = User::where('email', $request->email);
        if ($user->exists()) {
            $user = $user->first();

            // SEND OTP
            Helper::sendOtp($user->email);
            return $this->apiResponse(['message' => 'OTP sent successfully'], Response::HTTP_OK);
        }
        return $this->apiResponse([], Response::HTTP_NOT_FOUND);
    }
}
