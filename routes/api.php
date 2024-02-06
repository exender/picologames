<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\TokenController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\ModeController;
use App\Http\Controllers\Admin\PicoloController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamePlayerController;
use App\Events\Test;


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

Route::group(['prefix' => 'user'], function () {
    Route::get('edit/{id}', [UserController::class, 'edit']);
    Route::put('update/{id}', [UserController::class, 'update']);
});

Route::group(['prefix' => 'mode'], function () {
    Route::get('all', [ModeController::class, 'index']);
    Route::post('add', [ModeController::class, 'store']);
    Route::get('edit/{id}', [ModeController::class, 'edit']);
    Route::get('show/{id}', [ModeController::class, 'show']);
    Route::put('update/{id}', [ModeController::class, 'update']);
    Route::delete('delete/{id}', [ModeController::class, 'destroy']);
});

Route::group(['prefix' => 'picolo'], function () {
    Route::get('all', [PicoloController::class, 'index']);
    Route::get('all-suggested', [PicoloController::class, 'suggested']);
    Route::post('add', [PicoloController::class, 'store']);
    Route::get('edit/{picolo}', [PicoloController::class, 'edit']);
    Route::get('show/{id}', [PicoloController::class, 'show']);
    Route::put('update/{id}', [PicoloController::class, 'update']);
    Route::put('validate/{id}', [PicoloController::class, 'validatePiloco']);
    Route::delete('delete/{id}', [PicoloController::class, 'destroy']);
});




Route::get('play-game-picolo', function(){
    broadcast(new Test());
});


Route::post('create-game', [GameController::class, 'store']);

Route::post('play-game-picolo', function(){
    broadcast(new Test());
});


Route::put('add-player-game', [GameController::class, 'update']);


// Route::apiResource('game-players', GamePlayerController::class);


Route::get('game-players/{id}', [GamePlayerController::class, 'index']);
Route::post('game-players', [GamePlayerController::class, 'store']);


Route::post('redirect', [GameController::class, 'redirect']);
Route::post('next', [GameController::class, 'next']);


Route::post('msg', [GameController::class, 'msg']);
