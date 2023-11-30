<?php

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

Route::get('/upload','uploadController@upload')->name('upload');
Route::get('/download','downloadController@download')->name('upload');
Route::post('/process', 'UploadController@process')->name('process');
Route::get('/', function () {
    return view('welcome');
});
