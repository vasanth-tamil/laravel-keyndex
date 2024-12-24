<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     title="Project Mangement API",
 *     description="Simple project management api for commercial purpose",
 *     version="cosdb beta v1.0.0"
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */

abstract class Controller
{
    public function apiResponse($responseData, $status=200) {
        return response()->json($responseData, $status);
    }
}
