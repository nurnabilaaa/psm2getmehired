<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'dashboard']);
Route::match(['get', 'post'], 'register', [UserController::class, 'register']);
Route::get('pay/{userId}', [UserController::class, 'pay']);
Route::post('toyyibpay-callback', [UserController::class, 'toyyibpayCallback']);
Route::match(['get', 'post'], 'login', [UserController::class, 'login']);
Route::match(['get', 'post'], 'password/lost', [UserController::class, 'lostPassword']);
Route::match(['get', 'post'], 'password/reset/{token}', [UserController::class, 'newPassword']);

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|customer|consultant']], function () {
    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});

Route::get('/manage', [AdminController::class, 'manageAdmins']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/checkout', 'CheckoutController@afterpayment')->name('checkout.credit-card');

Route::post('/upload', [UploadController::class, 'uploadForm']);

route::view('/select', 'select');
route::view('/payment', 'payment');
route::view('/uploadcv', 'uploadcv');
route::view('/apply', 'apply');
route::view('/waiting', 'waiting');
route::view('/update', 'update');
route::view('/dashboard', 'dashboard');
route::view('/result', 'result');
route::view('/category', 'category');

route::view('/admin', 'admin');


Route::get('logout', [UserController::class, 'logout']);
