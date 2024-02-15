<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Registration
Route::post('/register', [AuthController::class, 'register']);

// User Login
Route::post('/login', [AuthController::class, 'login']);

// Password Reset Request
Route::post('/password/reset/request', [AuthController::class, 'sendResetLinkEmail']);

// Password Reset
Route::post('/password/reset', [AuthController::class, 'reset']);

Route::get('/users', [UserController::class, 'getUsers']);

Route::get('/products', [UserController::class, 'getProducts']);


