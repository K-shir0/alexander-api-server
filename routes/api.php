<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Idea\IndexIdeaController;
use App\Http\Controllers\Idea\RegisterIdeaController;
use App\Http\Controllers\User\RegisterUserController;
use App\Http\Controllers\User\ShowUserController;
use Illuminate\Support\Facades\Route;

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
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'signIn']); // ログイン
    Route::post('/logout', [AuthController::class, 'signOut']); // ログアウト
    Route::middleware('auth:sanctum')->get('/self', ShowUserController::class); // 自分の情報
});

Route::prefix('users')->group(function () {
    Route::post('/', RegisterUserController::class); // ユーザー登録
});

Route::prefix('ideas')->group(function () {
    Route::get('/', IndexIdeaController::class); // アイデア一覧
    Route::post('/', RegisterIdeaController::class); // アイデア登録
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
