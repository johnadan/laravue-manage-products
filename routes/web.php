<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// Route::get('/', function () {
//     return view('app');
// });

// Route::get('/login', function () {
//     return view('auth/login');
// })->name('login');

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '.*');

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '^(?!login).*$');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '^(?!login|register|password|sanctum).*$');

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '^(?!login|logout|register|password|sanctum).*$');

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '^(?!api|sanctum).*$');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!login|register|password|sanctum).*$');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
