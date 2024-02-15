<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('/register',  'register');
    Route::post('/login',  'login');
    Route::post('/password/reset/request',  'sendResetLinkEmail');
    Route::post('/password/reset',  'reset');
    Route::post('/logout',  'logout')->middleware( [ 'auth:api']);
});


Route::get('/users', [UserController::class, 'getUsers'])->middleware( [ 'auth:api' ]);

Route::apiResource('products' ,ProductController::class)->middleware( [ 'auth:api' ,'scope:products']);


