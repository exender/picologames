<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TokenController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\ModeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentificated', function () {
    return true;
});


Route::post('register', [RegisterController::class, 'index']);
Route::post('login', [LoginController::class, 'index']);
Route::post('logout', [LoginController::class, 'logout']);


Route::get('token/{id}', [TokenController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'index']);

Route::group(['prefix' => 'mode'], function () {
    Route::get('all', [ModeController::class, 'index']);
    Route::post('add', [ModeController::class, 'store']);
    Route::get('edit/{id}', [ModeController::class, 'edit']);
    Route::get('show/{id}', [ModeController::class, 'show']);
    Route::put('update/{id}', [ModeController::class, 'update']);
    Route::delete('delete/{id}', [ModeController::class, 'destroy']);
});
