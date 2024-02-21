<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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
    // return view('welcome');
    return view('card');
})->name('home');

// Route::get('/images_test/{name}?{token}' , function ($name , $token) {
//     if (!$token) {
//         return abort(403, 'no acess');
//     }
//     return public_path('images/'.$name);
// })->name('image');
//for testting
// Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
// Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
