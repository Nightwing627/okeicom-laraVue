<?php

use App\Http\Controllers\Auth\LoginController as UserLogin;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Auth\ForgotPasswordController as UserForgotPassword;
use App\Http\Controllers\Auth\RegisterController as UserRegister;
use App\Http\Controllers\Auth\ResetPasswordController as UserResetPassword;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
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
Route::prefix('owner-admin')->name('admins.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminLogin::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLogin::class, 'login']);
    });
    Route::post('logout', [AdminLogin::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        // 認証後ページ
        // ユーザ
        Route::get('users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('users/add', [AdminController::class, 'createUsers'])->name('users.create');
        Route::post('users/store', [AdminController::class, 'storeUsers'])->name('users.store');
        Route::get('users/edit', [AdminController::class, 'editUsers'])->name('users.edit');
        Route::post('users/update', [AdminController::class, 'updateUsers'])->name('users.update');
    });
});

// レッスン
Route::prefix('lessons')->name('lessons.')->group(function () {
    Route::get('/', [LessonController::class, 'index'])->name('index');
    Route::get('categories', [LessonController::class, 'category'])->name('categories');
    Route::middleware('auth')->group(function () {
        Route::get('{id}/application', [LessonController::class, 'application'])->name('application');
        Route::get('detail/credit-payment', [LessonController::class, 'paymentCredit'])->name('credit-payment');
        Route::get('detail/application/error', [LessonController::class, 'errorApplication'])->name('application.error');
        Route::get('detail/application/complete', [LessonController::class, 'completeApplication'])->name('application.complete');
        Route::get('detail/cancel', [LessonController::class, 'cancel'])->name('cancel');
        Route::post('detail/cancel', [LessonController::class, 'doCancel'])->name('cancel.do');
        Route::get('detail/cancel/complete', [LessonController::class, 'completeCancel'])->name('cancel.complete');
        Route::get('evaluation', [LessonController::class, 'createEvaluation'])->name('evaluation.create');
        Route::post('evaluation', [LessonController::class, 'storeEvaluation'])->name('evaluation.update');
        Route::get('evaluation/complete', [LessonController::class, 'completeEvaluation'])->name('evaluation.complete');
    });
    // ※ detail/{id} のルートは、detail/*** の各ルートの一番下に書くこと
    Route::get('detail/{id}', [LessonController::class, 'detail'])->name('detail');
});

// 講師一覧
Route::prefix('teachers')->name('teachers.')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('index');
    Route::get('category', [TeacherController::class, 'category'])->name('category');
    Route::get('detail/{id}', [TeacherController::class, 'detail'])->name('detail');
});
// 講師管理画面
Route::prefix('mypage/t')->name('mypage.t.')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('courses', [TeacherController::class, 'course'])->name('courses');
    Route::get('courses/detail/{courses_id}', [TeacherController::class, 'coursesDetail'])->name('courses.detail');
    Route::post('courses/update', [TeacherController::class, 'updateCourses'])->name('courses.update');
    Route::get('lessons/create/{courses_id}', [TeacherController::class, 'createLessons'])->name('lessons.create');
    Route::post('lessons/store', [TeacherController::class, 'storeLessons'])->name('lessons.store');
    Route::get('lesson-participation', [TeacherController::class, 'lessonsParticipation'])->name('lessons.participation');
    Route::get('lesson-participation/{lessons_id}', [TeacherController::class, 'lessonParticipationUsers'])->name('lessons.participation.users');
    Route::get('cancel-requests', [TeacherController::class, 'cancelRequests'])->name('cancel-requests');
});

// 受講者管理画面
Route::prefix('mypage/u')->name('mypage.u.')->middleware(['auth', 'student'])->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('attendance-lessons', [StudentController::class, 'attendanceLessons'])->name('attendance-lessons');
    // メッセージ
    Route::get('messages', [StudentController::class, 'messages'])->name('messages');
    Route::get('messages/{user_receive_id}', [StudentController::class, 'messageDetail'])->name('messages.detail');
    // プロフィール
    Route::get('profile', [StudentController::class, 'profile'])->name('profile');
    Route::get('profile/password', [StudentController::class, 'editPassword'])->name('profile.password.edit');
    Route::post('profile/password', [StudentController::class, 'updatePassword'])->name('profile.password.update');
    // 退会
    Route::get('withdrawal', [StudentController::class, 'createWithdrawal'])->name('withdrawal.create');
    Route::post('withdrawal', [StudentController::class, 'storeWithdrawal'])->name('withdrawal.store');
    Route::get('withdrawal/complete', [StudentController::class, 'completeWithdrawal'])->name('withdrawal.complete');
    // クレジットカード
    Route::get('creditcards', [StudentController::class, 'creditcards'])->name('creditcards');
    Route::get('creditcards/add', [StudentController::class, 'createCreditcards'])->name('creditcards.create');
    Route::post('creditcards/store', [StudentController::class, 'storeCreditcards'])->name('creditcards.store');
    Route::get('creditcards/edit', [StudentController::class, 'editCreditcards'])->name('creditcards.edit');
    Route::post('creditcards/update', [StudentController::class, 'updateCreditcards'])->name('creditcards.update');
    // 入出金
    Route::get('trade', [StudentController::class, 'trade'])->name('trade');
    Route::get('trade/withdrawal', [StudentController::class, 'createPayment'])->name('payment.create');
    Route::post('trade/withdrawal', [StudentController::class, 'storePayment'])->name('payment.store');
    Route::get('trade/withdrawal/complete', [StudentController::class, 'completePayment'])->name('payment.complete');
});

// 静的ページ
Route::name('pages.')->group(function () {
    Route::get('news', [PageController::class, 'news' ])->name('news');
    Route::get('news/detail/{id}', [PageController::class, 'newsDetail'])->name('news.detail');
    Route::get('company', [PageController::class, 'company'])->name('company');
    Route::get('terms-service', [PageController::class, 'termsService'])->name('terms-service');
    Route::get('terms-point', [PageController::class, 'termsPoint'])->name('terms-point');
    Route::get('terms-user', [PageController::class, 'termsUser'])->name('terms-user');
    Route::get('terms-teacher', [PageController::class, 'termsTeacher'])->name('terms-teacher');
    Route::get('tokushoho', [PageController::class, 'tokushoho'])->name('tokushoho');
    Route::get('faq', [PageController::class, 'faq'])->name('faq');
});
// 問い合わせ
Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('contact', [ContactController::class, 'doContact'])->name('contact.do');
