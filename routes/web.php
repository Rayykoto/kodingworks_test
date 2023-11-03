<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\User\UserController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard.index'));
});

Route::prefix('admin')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::get('success-reset', 'showSuccessResetPassword')->name('successreset');
        Route::post('login', 'login');
        Route::middleware(['auth'])->group(function () {
            Route::post('logout', 'logout')->name('logout');
        });
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('password/reset/{token}', 'showResetForm')->name('showResetForm');
        Route::post('password/reset', 'reset')->name('resetpassword');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('password/reset', 'showLinkRequestForm')->name('showlinkrequestform');
        Route::post('password/email', 'sendResetLinkEmail')->name('sendresetlinkemail');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return redirect(route('dashboard.index'));
        });

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard.index');
            Route::resource('/users', UserController::class);
            Route::resource('/roles', RoleController::class);
        });

        Route::controller(TaskController::class)->group(function () {
            Route::get('/task', 'index')->name('task.index');
            Route::get('/task/create', 'create')->name('task.create');
            Route::post('/task', 'store')->name('task.store');
            Route::get('/task/{id}/edit', 'edit')->name('task.edit');
            Route::put('/task/{id}', 'update')->name('task.update');
            Route::delete('task/{id}', 'destroy')->name('task.destroy');
        });

        require __DIR__ . '/admin/settings.php';
        require __DIR__ . '/admin/audits.php';
    });
});
