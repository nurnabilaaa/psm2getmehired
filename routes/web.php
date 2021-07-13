<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\AdminController;

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
Route::get('register', [UserController::class, 'register']);
Route::post('do-register', [UserController::class, 'doRegister']);
Route::get('login', [UserController::class, 'login']);
Route::post('do-login', [UserController::class, 'doLogin']);
Route::get('forget', [UserController::class, 'forget']);

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|customer|consultant']], function() {
    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});

Route::get('/manage', [AdminController::class,'manageAdmins']);

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
route::view('/category','category');

route::view('/admin','admin');




Route::get('logout',[UserController::class, 'logout']);
