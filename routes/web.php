<?php

use App\Notifications\Whatsapp;
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
    return redirect('/admin', 302);
});

// Google login
Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');

// if ($loginPage = config('filament.admin.auth.login')) {
//     Route::get('login', $loginPage)->name('login');
// }

// Route::get('whatsapp', function () {

//     $response = Whatsapp::make()
//         ->template('hello_world')
//         ->lang('en_US')
//         ->to('919940173174')
//         ->send();

//     return $response;
// });
