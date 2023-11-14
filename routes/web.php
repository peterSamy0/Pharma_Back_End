<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebMedicationController;
use App\Http\Controllers\WebPharmacyController;
use App\Http\Controllers\WebClientController;
use App\Http\Controllers\WebDeliveryController;
use App\Http\Controllers\WebOrderController;

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
    return view('dashboard');
});

Route::resource('medications', WebMedicationController::class);

Route::resource('pharmacies', WebPharmacyController::class);

Route::resource('clients', WebClientController::class);

Route::resource('deliveries', WebDeliveryController::class);

Route::resource('orders', WebOrderController::class);