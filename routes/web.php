<?php

use Illuminate\Support\Facades\Route;
use App\Events\Test;

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
Route::get('/broadcast', function(){
    broadcast(new Test());
});

Route::get('/{any}', function () {
    return view('layout');
})->where("any", ".*");


