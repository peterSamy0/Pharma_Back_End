<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebMedicationController;
use App\Http\Controllers\WebPharmacyController;
use App\Http\Controllers\WebClientController;
use App\Http\Controllers\WebDeliveryController;
use App\Http\Controllers\WebOrderController;
use App\Http\Controllers\WebCategoriesController;
use Illuminate\Support\Facades\Auth;



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
})->middleware('auth');


Route::resource('medications', WebMedicationController::class)->middleware('auth');

Route::resource('pharmacies', WebPharmacyController::class)->middleware('auth');

Route::resource('clients', WebClientController::class)->middleware('auth');

Route::resource('deliveries', WebDeliveryController::class)->middleware('auth');


 Route::resource('orders', WebOrderController::class)->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('orders', WebOrderController::class)->middleware('auth');

Route::resource('categories', WebCategoryController::class)->middleware('auth');

// pharmacy approval
Route ::put('pharmacyApprove/{id}' ,[ WebPharmacyController::class, 'approveAccount'])->name('pharmacy.approveAccount')->middleware('auth');
Route ::put('pharmacyReject/{id}' ,[ WebPharmacyController::class, 'rejectAccount'])->name('pharmacy.rejectAccount')->middleware('auth');


//delivery approval
Route ::put('deliveryApprove/{id}' ,[ WebDeliveryController::class, 'approveAccount'])->name('delivery.approveAccount')->middleware('auth');
Route ::put('deliveryReject/{id}' ,[ WebDeliveryController::class, 'rejectAccount'])->name('delivery.rejectAccount')->middleware('auth'); 

Route::get('stripe/{id}', [PaymentController::class , 'stripe']);
Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');

