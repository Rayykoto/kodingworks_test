<?php

use App\Http\Controllers\Settings\System\SystemController;
use App\Http\Controllers\Settings\System\RoleManagementController;

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
|
| Here is where you can register setting related routes for your application.
|
*/

Route::prefix('settings')->name('settings.')->group(function () {
    Route::controller(SystemController::class)->prefix('systems')->name('systems.')->group(function () {
        Route::prefix('role')->name('role.')->group(function () {
            Route::get('/', 'roleSettingIndex')->name('index');
            Route::controller(RoleManagementController::class)->group(function () {
                Route::get('get-data', 'getRoleList')->name('getdata');
                Route::get('add-role', 'createRolePage')->name('createpage');
                Route::get('{id}/edit-role', 'editRolePage')->name('editpage');
                Route::post('add-role', 'storeNewRole')->name('storerole');
                Route::put('{id}/update-role', 'updateRole')->name('updateRole');
                Route::delete('{id}/delete-role', 'deleteRole')->name('deleterole');
            });
        });
    });
});
