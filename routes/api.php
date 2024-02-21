<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionController;
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

// Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
// Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');


Route::controller(AuthController::class)->group(function () {
    Route::post('/register',  'register')->name('register');
    Route::post('/login',  'login')->name('login');
    Route::post('/password/reset/request',  'sendResetLinkEmail')->name('password.sendmail');
    Route::post('/password/reset',  'reset')->name('password.reset');
    Route::post('/logout',  'logout')->middleware(['auth:api']);
});

// Routes with 'auth' middleware
Route::middleware(['auth:api'])->controller(UserController::class)->group(function () {
    Route::get('/users',  'getUsers')->name('user.index');
    Route::get('/permissions', 'getPermissions')->name('permission.index');
    Route::get('/roles',  'getRoles')->name('role.index');
    Route::get('/role/{role}',  'getRole')->name('role.get');
    Route::put('/role/{role}',  'updateRole')->name('role.update');
    Route::put('/user/{user}',  'updateUser')->name('user.update');
});

// 'checkPermission' m 'changeDB'
Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('products', ProductController::class);
    // Route::apiResource('subscription', SubscriptionController::class);
    Route::apiResource('customers', CustomerController::class);   
});


Route::post('/generate-token', [PaymentController::class, 'generateToken'])->name('generate.token');

Route::post('/payment', [PaymentController::class,'processPayment']);

Route::post('/add-card', [PaymentController::class,'addcard']);

Route::get('/get-transactions', [PaymentController::class,'getTransactions']);

Route::post('/create-customer/{customer}', [PaymentController::class,'createCustomer']);



