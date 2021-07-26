<?php

use App\Http\Controllers\CurriculumVitaeController;
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
Route::match(['get', 'post'], 'register-customer', [UserController::class, 'registerCustomer']);
Route::match(['get', 'post'], 'register-consultant', [UserController::class, 'registerConsultant']);
Route::get('pay/{userId}', [UserController::class, 'pay']);
Route::post('toyyibpay-callback', [UserController::class, 'toyyibpayCallback']);
Route::match(['get', 'post'], 'login', [UserController::class, 'login']);
Route::match(['get', 'post'], 'password/lost', [UserController::class, 'lostPassword']);
Route::match(['get', 'post'], 'password/reset/{token}', [UserController::class, 'newPassword']);

Route::group(array('middleware' => 'auth'), function () {
    Route::resource('curriculum_vitae', CurriculumVitaeController::class);
    Route::get('user/{for}', [UserController::class, 'index']);
    Route::get('user/create/{for}', [UserController::class, 'create']);
    Route::get('user/edit/{for}/{id}', [UserController::class, 'edit']);
});


Route::get('logout', [UserController::class, 'logout']);
