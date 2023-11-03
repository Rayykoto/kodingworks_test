<?php

use App\Http\Controllers\Api\Auth\LoginController;
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

Route::prefix('auth')->group(function () {
    //route login api
    Route::post('/login', [LoginController::class, 'login', ['as' => 'auth']]);
    Route::post('/logout', [LoginController::class, 'logout', ['as' => 'auth']]);
});
Route::group(['middleware' => 'auth:api_admin'], function () {
    Route::apiResource('/tasks', App\Http\Controllers\Api\Task\TaskController::class, ['except' => ['create', 'edit'], 'as' => 'auth']);
});


Route::group(['prefix' => 'v1'], function () {
    Route::prefix('authentication')->group(function () {
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::post('/password/email', 'sendResetLinkEmail');
        });
        // Route::post('/password/reset', 'ResetPasswordController@reset')->name('api.reset.password');

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
