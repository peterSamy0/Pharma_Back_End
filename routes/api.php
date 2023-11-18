<?php

use App\Http\Controllers\AddMedicationsByPharmacyModelController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Logout;
use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\api\DeliveryController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\PharmacyMedicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
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
Route ::apiResource('pharmacyMedications' , PharmacyMedicationController::class);
Route::apiResource('deliveries',DeliveryController::class);
Route::apiResource('days',DayController::class);
Route::apiResource('users',UserController::class);
Route::apiResource('orders',OrderController::class);
Route::apiResource('governorates',GovernorateController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('addMedicatonsByPharmacy', AddMedicationsByPharmacyModelController::class);

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getuser']);
Route::get('clientsOrders/{id}', [ClientController::class, 'getClientOrders']);

Route ::put('deliveryApprove/{id}' ,[ DeliveryController::class, 'approveAccount']);
Route ::put('deliveryReject/{id}' ,[ DeliveryController::class, 'rejectAccount']);

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

// Route::post('/createCheckoutSession', [PaymentController::class, 'createCheckoutSession']);
// Route::post('/process-payment', 'PaymentController@processPayment');
// Route::get('/create-subscription-product', [PaymentController::class, 'createSubscriptionProduct']);
// Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);

// Route::get('success', [PaymentController::class,'success']);
// Route::get('error', [PaymentController::class,'error']);
// routes/api.php or routes/web.php
// Route::post('/pay', 'PaymentController@pay')->name('pay');



// Route::get('stripe', [PaymentController::class , 'stripe']);
// Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');

Route::get('/laravel-route', function () {
    return view('your-blade-view');  // Replace 'your-blade-view' with the actual Blade view name
});