<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManageController;

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

// 管理者認証
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // 認証済みルート

        // 管理者
        Route::apiResource('/manages', ManageController::class);
    });
});
