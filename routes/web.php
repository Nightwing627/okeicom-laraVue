<?php

use App\Http\Controllers\Auth\LoginController as UserLogin;
use App\Http\Controllers\Auth\ForgotPasswordController as UserForgotPassword;
use App\Http\Controllers\Auth\ResetPasswordController as UserResetPassword;
use App\Http\Controllers\Auth\Admin\ResetPasswordController as AdminResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('top');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ユーザー認証
Route::get('login', [UserLogin::class, 'showLoginForm'])->name('login');
Route::post('login', [UserLogin::class, 'login']);
Route::post('logout', [UserLogin::class, 'logout'])->name('logout');
Route::get('password-reset', [UserForgotPassword::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password-email', [UserForgotPassword::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password-reset/new/{token}', [UserResetPassword::class, 'showResetForm'])->name('password.reset');
Route::post('password-reset/new', [UserResetPassword::class, 'reset'])->name('password.update');

// 管理者認証
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('password/reset/{token}', [AdminResetPassword::class, 'showResetForm'])->name('password.reset');
});
