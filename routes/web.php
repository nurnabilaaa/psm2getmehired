<?php

use App\Http\Controllers\UploadController;

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

Route::get('/new-login', function () {
    return view('newLogin');
});

Route::get('/new-register', function () {
    return view('newRegister');
});

Route::get('/new-forget', function () {
    return view('newForget');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/checkout', 'CheckoutController@afterpayment')->name('checkout.credit-card');

Route::post('/upload', [UploadController::class, 'uploadForm']);

route::view('/select','select' );
route::view('/payment','payment' );
route::view('/uploadcv','uploadcv' );
route::view('/apply','apply' );
route::view('/waiting','waiting' );
route::view('/update','update' );
route::view('/dashboard','dashboard' );
route::view('/result','result');


// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/user', 'UserController@index')->name('user');
// Route::get('/admin', 'AdminController@index')->name('admin');
// Auth::routes();