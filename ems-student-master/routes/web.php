<?php

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

Route::get('/', 'IndexController@login')->name('login');
Route::post('/', 'IndexController@signin');
Route::get('/join', 'RegisterController@index')->name('register');
Route::post('/join', 'RegisterController@store');
Route::get('/activate-email/{user}', 'RegisterController@verify_email')->name('activate-email');
Route::get('email/verify', 'RegisterController@resend');
Route::get('email/resend', 'RegisterController@resend_verification')->name('verification.resend');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
Route::post('/signout', 'IndexController@getLogout')->name('signout');

/** ===========================Password Reset Routes=============================*/
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
/** ===========================End Password Reset Routes=============================*/

/** =========================== Member Routes=============================*/
Route::prefix('dashboard')->middleware('auth', 'active')->group(function () {
    Route::get('/', 'Member\IndexController@index')->middleware('member');
    Route::get('/cert', 'Member\CertificateController@print_cert')->middleware('member');
    Route::post('/update', 'Member\IndexController@update')->middleware('member');
    Route::get('/enroll', 'Member\EnrollController@index')->middleware('member');
    Route::post('/enroll', 'Member\EnrollController@enroll')->middleware('member');
    Route::get('/units', 'Member\IndexController@units')->middleware('member');
    Route::get('/payments', 'Member\IndexController@payments')->middleware('member');
    Route::get('/certificates', 'Member\IndexController@certificates')->middleware('member');
    Route::get('/certificate/{id}/print', 'Member\CertificateController@print_certificate')->middleware('member');
    Route::get('/result-slip/{id}/show', 'Member\ResultslipController@show')->middleware('member');
    Route::get('/result-slip/{id}/download', 'Member\ResultslipController@download')->middleware('member');
    Route::get('/books/{id}', 'Member\IndexController@books')->middleware('member');
    Route::get('/exams/{id}', 'Member\IndexController@exams')->middleware('member');
    // ----------------Extras ---
    Route::get('/enroll/course/{id}', 'Admin\EnrollmentController@units')->middleware('member');
    Route::get('/receipt/{id}', 'Admin\PaymentController@receipt')->middleware('member');
});

/** =========================== Answer and Results Routes=============================*/
Route::prefix('exams')->middleware('auth', 'active')->group(function () {
    Route::post('/submit-answer', 'Member\AnswerController@store')->middleware('member');
    Route::get('/result/{id}', 'Member\ResultController@index')->middleware('member');
});

/** =========================== Answer and Results Routes=============================*/

/** ===========================Dashboard Routes=============================*/
Route::prefix('member')->middleware('auth', 'active')->group(function () {
    Route::get('/profile', 'Admin\IndexController@profile')->middleware('member');
    Route::post('/profile', 'Admin\IndexController@updateProfile')->middleware('member');
    Route::get('/password', 'Admin\IndexController@getPassword')->middleware('member');
    Route::post('/password', 'Admin\IndexController@changePassword')->middleware('member');
    Route::get('/', 'Admin\IndexController@index')->middleware('member');
    // ----------------Extras ---
    Route::get('/certificate', 'Member\CertificateController@index')->middleware('member');
    Route::get('/result-slip', 'Member\ResultslipController@index')->middleware('member');
    Route::get('/book/{id}/read', 'Member\IndexController@read')->middleware('member');


});
/**========================= end Dashboard routes=================================*/

