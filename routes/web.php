<?php

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

Route::get('/', function () {
    return view('welcome');
});

//User Routes
Route::group(
    ['prefix' => 'user'], function(){
        Route::match(['get', 'post'], '/register', [\App\Http\Controllers\User\AuthController::class, 'register'])->name('user.register');
        Route::match(['get', 'post'], '/login', [\App\Http\Controllers\User\AuthController::class, 'login'])->name('user.login');
    }
);

//Vendor Routes
Route::group(
    ['prefix' => 'vendor'], function(){
        Route::match(['get', 'post'], '/register', [\App\Http\Controllers\Vendor\AuthController::class, 'register'])->name('vendor.register');
        Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Vendor\AuthController::class, 'login'])->name('vendor.login');
    }
);