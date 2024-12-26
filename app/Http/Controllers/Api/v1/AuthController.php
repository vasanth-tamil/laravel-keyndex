<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Enums\LoginTypeEnum;
use App\Enums\VerificationTypeEnum;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\LoginActivity;
use App\Models\VerificationCode;

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

        // SEND OTP
        VerificationCode::create([
            'code' => Helper::getOTP(),
            'type' => VerificationTypeEnum::EMAIL->value,
            'is_used' => false,
            'expires_at' => now()->addMinutes(5),
            'user_id' => $user->id
        ]);

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

            // VERIFY EMAIL
            if ($user->email_verified_at == null) {
                return $this->apiResponse(['error' => 'email not verified.'], Response::HTTP_UNAUTHORIZED);
            }

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

    public function verify_otp(Request $request)
    {
        // CHECK OTP MATCH
        $verify = VerificationCode::unusedEmailCode($request->user()->id, $request->otp)->first();

        // Check if OTP exists
        if (!$verify) {
            return $this->apiResponse(['errors' => 'OTP does not match or has already been used.'], Response::HTTP_BAD_REQUEST);
        }

        // CHECK IF OTP IS EXPIRED
        if ($verify->isExpired()) {
            return $this->apiResponse(['errors' => 'OTP expired.'], Response::HTTP_BAD_REQUEST);
        }

        // MARK OTP AS USED
        $verify->is_used = true;
        $verify->save();

        // MARK EMAIL AS VERIFIED
        $user = $request->user();
        $user->email_verified_at = now();
        $user->save();

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

        // REMOVE CURRENT TOKEN
        $request->user()->currentAccessToken()->delete();

        // SEND REFRESH TOKEN
        $authToken = $user->createToken($user->id . '-access-token')->plainTextToken;

        $data = [
            'access_token' => $authToken,
            'user' => $user
        ];

        return $this->apiResponse($data, Response::HTTP_OK);
    }

    public function resend_otp(Request $request) {
        $validateData = $request->validate([
            "email" => "required|email|exists:users,email",
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->exists()) {
            $otpCount = VerificationCode::dailyOtpCount($user->id, VerificationTypeEnum::EMAIL->value);

            if ($otpCount >= 6) {
                return $this->apiResponse(['errors' => 'Daily OTP limit reached.'], Response::HTTP_TOO_MANY_REQUESTS);
            }

            // SEND OTP
            VerificationCode::updateOrCreate([
                'code' => Helper::getOTP(),
                'type' => VerificationTypeEnum::EMAIL->value,
                'is_used' => false,
                'expires_at' => now()->addMinutes(5),
                'user_id' => $user->id
            ]);

            return $this->apiResponse(['message' => 'OTP sent successfully'], Response::HTTP_OK);
        }
        return $this->apiResponse([], Response::HTTP_NOT_FOUND);
    }

    public function forget_password(Request $request)
    {
        $validateData = $request->validate([
            "email" => "required|email|exists:users,email",
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user->exists()) {
            $user = $user->first();

            // SEND OTP
            VerificationCode::create([
                'code' => Helper::getOTP(),
                'type' => VerificationTypeEnum::EMAIL->value,
                'is_used' => false,
                'expires_at' => now()->addMinutes(5),
                'user_id' => $user->id
            ]);

            return $this->apiResponse(['message' => 'OTP sent successfully'], Response::HTTP_OK);
        }
        return $this->apiResponse([], Response::HTTP_NOT_FOUND);
    }
}
