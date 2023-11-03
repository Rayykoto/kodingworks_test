<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api_admin')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => auth()->guard('api_admin')->user(),
            'token' => $token
        ]);
    }

    public function logout()
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'success' => true,
        ], 200);
    }
}
