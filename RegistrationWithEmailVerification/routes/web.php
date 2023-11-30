<?php

use App\Http\Controllers\auth\LoginRegisterController;
use App\Http\Controllers\auth\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Defining Custom user registration and login routes;
Route::controller(LoginRegisterController::class)->group(function (){
Route::get('/register', 'register')->name('register');
Route::post('/store','store')->name('store');
Route::get('/login','login')->name('login');
Route::post('/authenticate','authenticate')->name('authenticate');
Route::get('/home','home')->name('home');
Route::post('/logout','logout')->name('logout');
});
//Defining Custom verification Routes
Route::controller(VerificationController::class)->group(function (){
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});
