<?php

use Illuminate\Http\Request;
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

// 管理者
Route::prefix('manages')->group(function () {
    Route::get('/', [ManageController::class, 'index']);
    Route::get('/show/{id}', [ManageController::class, 'show']);
    Route::post('store', [ManageController::class, 'store']);
    Route::post('/update/{id}', [ManageController::class, 'update']);
});
