<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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
Route::group(['namespace'=>'App\http\Controllers'], function(){
    Route::get('image_upload','ImageUploadController@index')->name('image_upload.index');
    Route::post('image_upload', 'ImageUploadController@index')->name('image_upload.post');

});
