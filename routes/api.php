<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ClientController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PharmacyController;

use App\Http\Controllers\api\DeliveryController;
use App\Http\Controllers\api\DeliveryPhoneController;
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

// Route::apiResource('deliveries_Phone',DeliveryPhoneController::class)


// authentication and authorization route
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);