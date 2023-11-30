<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
Route::group(['namespace'=>'App\Http\Controllers'],function(){
    Route::get('/','PagesController@index')->name('pages.index');
    Route::get('/about','PagesController@about')->name('pages.about');
    route::get('/contact','PagesController@about')->name('pages.contact');

});
