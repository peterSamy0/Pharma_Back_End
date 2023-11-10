<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Logout;
use App\Http\Controllers\ClientController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\api\DeliveryController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\api\DeliveryPhoneController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\UserController;
use App\Models\Governorate;
use App\Models\Order;
use App\Http\Controllers\ContactusController;

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

Route::apiResource('clients', ClientController::class);
Route ::apiResource('medications' , MedicationController::class);
Route ::apiResource('pharmacies' , PharmacyController::class);
Route::apiResource('deliveries',DeliveryController::class);
Route::apiResource('days',DayController::class);
Route::apiResource('users',UserController::class);
Route::apiResource('orders',OrderController::class);
Route::apiResource('governorates',GovernorateController::class);

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getuser']);


// Route::apiResource('deliveries_Phone',DeliveryPhoneController::class)


// authentication and authorization route
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [Logout::class, 'logout']);

Route::resource('contactus', ContactusController::class);

// use App\Http\Controllers\PayPalController;

// Route::post('/api/create-paypal-order', [PayPalController::class, 'createOrder']);
// Route::post('/api/execute-paypal-order', [PayPalController::class, 'executeOrder']);


use App\Http\Controllers\PaymentController;


// Route::post('/payment/process', 'PaymentController@processPayment');

Route::post('/pay', [PaymentController::class, 'pay']);
// Route::post('/process-payment', 'PaymentController@processPayment');

// Route::get('success', [PaymentController::class,'success']);
// Route::get('error', [PaymentController::class,'error']);
// routes/api.php or routes/web.php
// Route::post('/pay', 'PaymentController@pay')->name('pay');
