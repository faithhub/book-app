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
    ['prefix' => 'user'],
    function () {
        Route::match(['get', 'post'], '/register', [\App\Http\Controllers\User\AuthController::class, 'register'])->name('user.register');
        Route::match(['get', 'post'], '/login', [\App\Http\Controllers\User\AuthController::class, 'login'])->name('user.login');
        Route::match(['get'], '/logout', [\App\Http\Controllers\User\AuthController::class, 'logout'])->name('user.logout');
        Route::group(['middleware' => ['auth.user']], function () {
            Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
            Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\User\SettingsController::class, 'profile'])->name('user.profile');
            Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\User\SettingsController::class, 'change_password'])->name('user.change.password');
        });
    }
);

//Vendor Routes
Route::group(
    ['prefix' => 'vendor'],
    function () {
        Route::match(['get', 'post'], '/register', [\App\Http\Controllers\Vendor\AuthController::class, 'register'])->name('vendor.register');
        Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Vendor\AuthController::class, 'login'])->name('vendor.login');
        Route::match(['get'], '/logout', [\App\Http\Controllers\Vendor\AuthController::class, 'logout'])->name('vendor.logout');
        Route::group(['middleware' => ['auth.vendor']], function () {
            //Dashboard
            Route::get('/', [\App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('vendor.dashboard');

            //About Us
            Route::get('/about', [\App\Http\Controllers\Vendor\DashboardController::class, 'about'])->name('vendor.about');
            
            //Inbox
            Route::get('/inbox', [\App\Http\Controllers\Vendor\DashboardController::class, 'inbox'])->name('vendor.inbox');
            
            //Profile
            Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Vendor\SettingsController::class, 'profile'])->name('vendor.profile');
            
            //Update Password
            Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Vendor\SettingsController::class, 'change_password'])->name('vendor.change.password');
            
            //Books
            Route::get('/my-books', [\App\Http\Controllers\Vendor\BookController::class, 'my_books'])->name('vendor.my.books');
            Route::match(['get', 'post'], '/upload-new-book', [\App\Http\Controllers\Vendor\BookController::class, 'upload_new_book'])->name('vendor.upload.new.book');
            Route::get('/view-book/{id}', [\App\Http\Controllers\Vendor\BookController::class, 'view_book'])->name('vendor.view.book');
        });
    }
);
