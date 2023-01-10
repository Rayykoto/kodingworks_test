<?php

use App\Http\Controllers\Audits\ApiLog\ApiLogController;
use App\Http\Controllers\Audits\AdminLog\AdminLogController;

/*
|--------------------------------------------------------------------------
| Audits Routes
|--------------------------------------------------------------------------
|
| Here is where you can register setting related routes for your application.
|
*/



Route::prefix('audits')->name('audits.')->group(function () {
    Route::controller(AdminLogController::class)->prefix('admin-logs')->name('admin-logs.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('get-data', 'getData')->name('getdata');
    });

    Route::controller(ApiLogController::class)->prefix('api-logs')->name('api-logs.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('get-data', 'getData')->name('getdata');
    });
});
