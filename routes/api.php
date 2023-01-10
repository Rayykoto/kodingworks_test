<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthenticationController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::prefix('authentication')->group(function () {
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::post('/password/email', 'sendResetLinkEmail');
        });
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('api.reset.password');

        Route::controller(AuthenticationController::class)->group(function () {
            Route::post('login', 'login');

            Route::middleware(['JwtMiddleware'])->group(function () {
                Route::get('logout', 'logout');
                Route::post('refresh', 'refresh');
            });
        });
    });

    Route::middleware(['JwtMiddleware'])->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::put('fcm-token', 'updateFCM');
        });
    });
});