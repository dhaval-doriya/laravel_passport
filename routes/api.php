<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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
    Route::post('/logout',  'logout')->middleware(['auth:api']);
});





// Routes with 'auth' middleware
Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('products' ,ProductController::class)->middleware( ['scope:products']);
    
    Route::get('/users', [UserController::class, 'getUsers'])->middleware(['scope:view-users']);
    Route::get('/permissions', [UserController::class, 'getPermissions']);
    Route::get('/roles', [UserController::class, 'getRoles']);
    Route::put('/role/{role}', [UserController::class, 'updateRole']);

    Route::put('/user/{user}', [UserController::class, 'updateUser']);

});


Route::post('/auth/Oauth', [AuthController::class, 'oauth'])->name('oauth.simulate');



