<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CalculatorController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CalculatorController::class, 'showForm'])->name('calculator');

Route::post('/calculate', [CalculatorController::class, 'calculate'])->name('calculate');

Route::post('/result', [CalculatorController::class, 'result'])->name('result');

