<?php

namespace App\Services\Api\V1\Auth;


class AuthenticationService
{
    public function login($request)
    {
        if ($token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth('api')->user();
            $data = $user;
            $data['token'] = $token;
            return $data;
        } else {
            throw new \Exception('Email atau Password Anda salah, hub admin bila ingin merubahnya', 400);
        }
    }

    public function updateFcmToken($request)
    {
        $input = $request->only(['fcm_token']);
        $user = auth('api')->user();
        $user->update($input);

        return $user;
    }
}
