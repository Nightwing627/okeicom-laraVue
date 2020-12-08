<?php

use App\Http\Controllers\Auth\LoginController as UserLogin;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Auth\ForgotPasswordController as UserForgotPassword;
use App\Http\Controllers\Auth\RegisterController as UserRegister;
use App\Http\Controllers\Auth\ResetPasswordController as UserResetPassword;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ユーザー認証
Route::get('login', [UserLogin::class, 'showLoginForm'])->name('login');
Route::post('login', [UserLogin::class, 'login']);
Route::post('logout', [UserLogin::class, 'logout'])->name('logout');
Route::get('password-reset', [UserForgotPassword::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password-email', [UserForgotPassword::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password-reset/new/{token}', [UserResetPassword::class, 'showResetForm'])->name('password.reset');
Route::post('password-reset/new', [UserResetPassword::class, 'reset'])->name('password.update');
Route::get('password-reset/complete', [UserResetPassword::class, 'complete'])->name('password.complete');
Route::get('sign-up', [UserRegister::class, 'showEmailVerifyForm'])->name('email.verify');
Route::post('email-send', [UserRegister::class, 'emailVerify'])->name('email.verify.send');
Route::get('email-send/complete', [UserRegister::class, 'completeEmailSend'])->name('email.send.complete');
Route::get('sign-up/register/{token}', [UserRegister::class, 'showRegistrationForm'])->name('sign-up.show');
Route::post('sign-up/register/{token}', [UserRegister::class, 'register'])->name('sign-up.store');
Route::get('sign-up/complete', [UserRegister::class, 'completeRegister'])->name('sign-up.complete');

// 管理者認証
Route::prefix('owner-admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLogin::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLogin::class, 'login']);
    Route::post('logout', [AdminLogin::class, 'logout'])->name('logout');
});

// レッスン
Route::prefix('lessons')->name('lessons.')->group(function () {
    Route::get('/', [LessonController::class, 'index'])->name('index');
    Route::get('categories', [LessonController::class, 'category'])->name('categories');
});

// 講師管理画面
Route::prefix('mypage/t')->name('mypage.t.')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('courses', [TeacherController::class, 'course'])->name('courses');
    Route::get('courses/detail/{courses_id}', [TeacherController::class, 'coursesDetail'])->name('courses.detail');
    Route::post('courses/update', [TeacherController::class, 'coursesUpdate'])->name('courses.update');
    Route::get('lessons/create/{courses_id}', [TeacherController::class, 'lessonsCreate'])->name('lessons.create');
    Route::post('lessons/store', [TeacherController::class, 'lessonsStore'])->name('lessons.store');
    Route::get('lesson-participation', [TeacherController::class, 'lessonsParticipation'])->name('lessons.participation');
    Route::get('lesson-participation/{lessons_id}', [TeacherController::class, 'lessonParticipationUsers'])->name('lessons.participation.users');
    Route::get('cancel-requests', [TeacherController::class, 'cancelRequests'])->name('cancel-requests');
});
