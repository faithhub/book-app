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

// Route::get('/', function () {
//     return view('welcome');
// });

//Login
Route::match(['get', 'post'], '/', [\App\Http\Controllers\User\AuthController::class, 'login'])->name('user.login');

//User Routes
Route::group(
    ['prefix' => 'user'],
    function () {
        Route::match(['get', 'post'], '/register', [\App\Http\Controllers\User\AuthController::class, 'register'])->name('user.register');
        Route::match(['get', 'post'], '/login', [\App\Http\Controllers\User\AuthController::class, 'login'])->name('user.login');
        Route::match(['get'], '/logout', [\App\Http\Controllers\User\AuthController::class, 'logout'])->name('user.logout');
        Route::group(['middleware' => ['auth.user']], function () {
            Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
            
            //View Book
            Route::get('/view-book/{name}/{id}', [\App\Http\Controllers\User\DashboardController::class, 'view_book'])->name('user.view.book')->middleware('book.rate');
            
            //View material based on type
            Route::get('/view-book-type/{name}/{id}', [\App\Http\Controllers\User\DashboardController::class, 'material'])->name('user.material')->middleware('book.rate');

            //Rate Material
            Route::match(['get', 'post'], '/rate', [\App\Http\Controllers\User\DashboardController::class, 'rate'])->name('user.rate');
            
            //Payment History
            Route::get('/transactions', [\App\Http\Controllers\User\DashboardController::class, 'payment_history'])->name('user.payment.history')->middleware('book.rate');
            Route::post('/save-payment', [\App\Http\Controllers\User\DashboardController::class, 'save_payment'])->name('user.save.payment')->middleware('book.rate');
            
            //Access book
            Route::get('/access-book/{name}/{id}', [\App\Http\Controllers\User\DashboardController::class, 'access_book'])->name('user.access_book')->middleware('book.rate');
            
            //Bought Books
            Route::get('/bought-books', [\App\Http\Controllers\User\DashboardController::class, 'bought_books'])->name('user.bought')->middleware('book.rate');
            
            //Rent Books
            Route::get('/rent-books', [\App\Http\Controllers\User\DashboardController::class, 'rent_books'])->name('user.rent')->middleware('book.rate');
            
            //Add to car
            Route::post('/add-cart', [\App\Http\Controllers\User\DashboardController::class, 'add_cart'])->name('user.add.cart');
            Route::post('/remove-cart', [\App\Http\Controllers\User\DashboardController::class, 'remove_cart'])->name('user.remove.cart')->middleware('book.rate');
            Route::match(['get', 'post'], '/checkout', [\App\Http\Controllers\User\DashboardController::class, 'checkout'])->name('user.checkout');
            
            //Search Book
            Route::match(['get', 'post'], '/search-book', [\App\Http\Controllers\User\DashboardController::class, 'search'])->name('user.search')->middleware('book.rate');

            //Settings
            Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\User\SettingsController::class, 'profile'])->name('user.profile')->middleware('book.rate');
            Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\User\SettingsController::class, 'change_password'])->name('user.change.password')->middleware('book.rate');
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
            
            //Policy
            Route::get('/policy', [\App\Http\Controllers\Vendor\DashboardController::class, 'policy'])->name('vendor.policy');

            //Inbox
            Route::match(['get', 'post'], '/create', [\App\Http\Controllers\Vendor\DashboardController::class, 'create'])->name('vendor.create');
            Route::match(['get'], '/sent', [\App\Http\Controllers\Vendor\DashboardController::class, 'sent'])->name('vendor.sent');
            Route::match(['get'], '/inbox', [\App\Http\Controllers\Vendor\DashboardController::class, 'inbox'])->name('vendor.inbox');
            
            //Profile
            Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Vendor\SettingsController::class, 'profile'])->name('vendor.profile');
            
            //Update Password
            Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Vendor\SettingsController::class, 'change_password'])->name('vendor.change.password');
            
            //Books
            Route::get('/my-books', [\App\Http\Controllers\Vendor\BookController::class, 'my_books'])->name('vendor.my.books');
            Route::match(['get', 'post'], '/upload-new-book', [\App\Http\Controllers\Vendor\BookController::class, 'upload_new_book'])->name('vendor.upload.new.book');
            Route::get('/view-book/{id}', [\App\Http\Controllers\Vendor\BookController::class, 'view_book'])->name('vendor.view.book');
            Route::match(['get', 'post'], '/edit-book/{name}/{id}', [\App\Http\Controllers\Vendor\BookController::class, 'edit_book'])->name('vendor.edit.book');
            Route::post('/save-edit-book', [\App\Http\Controllers\Vendor\BookController::class, 'save_edit_book'])->name('vendor.save_edit.book');
            
            //Access book
            Route::get('/access-book/{name}/{id}', [\App\Http\Controllers\Vendor\BookController::class, 'access_book'])->name('vendor.access_book');
        });
    }
);


//Admin Routes
Route::group(
    ['prefix' => 'admin'],
    function () {
        // Route::match(['get', 'post'], '/register', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('admin.register');
        Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
        Route::match(['get'], '/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
        Route::group(['middleware' => ['auth.admin']], function () {
            //Dashboard
            Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
            
            //Vendors
            Route::get('/vendors', [\App\Http\Controllers\Admin\DashboardController::class, 'vendors'])->name('admin.vendors');
            
            //Users
            Route::get('/users', [\App\Http\Controllers\Admin\DashboardController::class, 'users'])->name('admin.users');

            //About Us
            Route::get('/about', [\App\Http\Controllers\Admin\DashboardController::class, 'about'])->name('admin.about');
            Route::match(['get', 'post'], '/edit-about', [\App\Http\Controllers\Admin\DashboardController::class, 'edit_about'])->name('admin.edit.about');
            
            //Policy Us
            Route::get('/policy', [\App\Http\Controllers\Admin\DashboardController::class, 'policy'])->name('admin.policy');
            Route::match(['get', 'post'], '/edit-policy', [\App\Http\Controllers\Admin\DashboardController::class, 'edit_policy'])->name('admin.edit.policy');
            
            //Inbox
            Route::match(['get', 'post'], '/create', [\App\Http\Controllers\Admin\DashboardController::class, 'create'])->name('admin.create');
            Route::match(['get'], '/sent', [\App\Http\Controllers\Admin\DashboardController::class, 'sent'])->name('admin.sent');
            Route::match(['get'], '/inbox', [\App\Http\Controllers\Admin\DashboardController::class, 'inbox'])->name('admin.inbox');
            
            //Profile
            Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Admin\SettingsController::class, 'profile'])->name('admin.profile');

            //Update Password
            Route::match(['get', 'post'], '/change-password', [\App\Http\Controllers\Admin\SettingsController::class, 'change_password'])->name('admin.change.password');
            
            //Books
            Route::get('/materials', [\App\Http\Controllers\Admin\DashboardController::class, 'materials'])->name('admin.materials');
            Route::get('/view-material/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'view_material'])->name('admin.view.material');
            Route::get('/delete-material/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'delete_material'])->name('admin.delete.material');
            Route::get('/access-material/{name}/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'access'])->name('admin.access.material');
        });
    }
);
