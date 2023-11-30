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
//Routes for students;
Route::resource('students', 'StudentController')->middleware('auth');
Route::get('students/{student}/enroll', 'EnrollmentController@create')->name('students.enroll')->middleware('auth');
Route::post('students/{student}/enroll', 'EnrollmentController@store')->name('students.enroll.store')->middleware('auth');


//Routes for the teachers;

Route::resource('teachers', 'TeacherController')->middleware('auth');

//Route for the guardians

Route::get('guardians/{guardian}/students/{student}', 'GuardianController@show')->name('guardians.show')->middleware('auth');
Route::get('guardians/{guardian}/edit', 'GuardianController@edit')->name('guardians.edit')->middleware('auth');
Route::put('guardians/{guardian}/update', 'GuardianController@update')->name('guardians.update')->middleware('auth');

//Routes for attendance;

Route::get('attendance', 'AttendanceController@create')->name('attendance.create')->middleware('auth');
Route::post('attendance', 'AttendanceController@store')->name('attendance.store')->middleware('auth');

//Routes for the enrollment


Route::get('enrollments/create', 'EnrollmentController@create')->name('enrollments.create')->middleware('auth');
Route::post('enrollments', 'EnrollmentController@store')->name('enrollments.store')->middleware('auth');
