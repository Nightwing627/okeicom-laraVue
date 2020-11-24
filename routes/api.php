<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManageController;
use App\Http\Controllers\Auth\Admin\LoginController;

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
    Route::post( 'login', [ LoginController::class, 'login' ] )->name( 'login' );

    Route::middleware('auth:sanctum')->group(function () {
        // 認証済みルート

        // 管理者
        Route::apiResource('/manages', ManageController::class);
    });
});
