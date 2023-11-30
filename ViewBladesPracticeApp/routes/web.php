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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/second', function () {
    return view('second');
});
//Route to return the third view>> uses the get method
Route::get('/third', function (){
    return view('third');
});

Route::get('/form',function(){
    return view('form');

});
//Passing data from a route handler to a view
Route::get('/pizza',function (){

    $pizzas=[
        ['type'=>'hawaiian', 'base'=>'cheesy-crust'],
        ['type'=>'volcano', 'base'=>'garlic-crust'],
        ['type'=>'veg supreme', 'base'=>'thin & crispy']
        ];
    return view('pizza',['pizzas'=>$pizzas]);
});
