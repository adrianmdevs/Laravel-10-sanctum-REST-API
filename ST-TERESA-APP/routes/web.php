<?php

use App\Models\Guardian;
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
Route::middleware(['Guardian'])->group(function(){
    //Add view based on permissions

});
Route::middleware('Staff')->group(function(){
    //View based on role and permissions
});
Route::middleware('Teacher')->group(function(){

});
