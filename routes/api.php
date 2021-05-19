<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManageController;
use App\Http\Controllers\Api\LessonsController;
use App\Http\Controllers\Api\v1\AnnouncementController;
use App\Http\Controllers\Api\v1\WithdrawalController;
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

// レッスン一覧情報取得API
Route::resource('v1/lessons', LessonsController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// 出金リクエスト
Route::resource('v1/withdrawals', WithdrawalController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
// お知らせ
Route::resource('v1/announcements', AnnouncementController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// 管理者認証
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        // 認証済みルート

        // 管理者
        Route::apiResource('/manages', ManageController::class);

    });
});
