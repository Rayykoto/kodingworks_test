<?php

namespace App\Http\Controllers\Api\V1\Auth;

use stdClass;
use Illuminate\Http\Request;
use App\Events\Authentication\Login;
use App\Events\Authentication\Logout;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\V1\Auth\UpdateFcmRequest;
use App\Services\Api\V1\Auth\AuthenticationService;
use App\Http\Resources\Api\V1\Auth\UpdateFcmResource;
use App\Http\Resources\Api\V1\Auth\RefreshTokenResource;
use App\Http\Resources\Api\V1\Auth\AuthenticationResource;

class AuthenticationController extends ApiBaseController
{
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login(Request $request)
    {
        try {
            $data = $this->authenticationService->login($request);

            $user = new AuthenticationResource($data, "Success Login");
            event(new Login(auth('api')->user(), [], [], $request->only(['email', 'password']), $user));
            
            return $this->respond($user);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        try {
            event(new Logout(auth('api')->user()));
            
            auth('api')->logout();
            return $this->messageSuccess('Success Logout', 200);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }

    public function updateFCM(UpdateFcmRequest $request)
    {
        try {
            $data = $this->authenticationService->updateFcmToken($request);

            $result = new UpdateFcmResource($data, "Success Update FCM Token");
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }

    public function refresh()
    {
        try {
            $data = new stdClass();
            $data->token = auth('api')->refresh();

            $final = new RefreshTokenResource($data, 'Success Refresh Token');
            return $this->respond($final);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }
}
