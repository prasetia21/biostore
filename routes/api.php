<?php

use App\Http\Controllers\Api\TesController;
use App\Http\Controllers\Api\TokenNinjaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Guest\User\CheckoutGuestController;
use App\Http\Controllers\User\MidtransController;
use App\Http\Controllers\Guest\User\MidtransGuestController;
use App\Http\Controllers\User\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::post('webhook', [MidtransController::class, 'midtransHandler']);

Route::post('generate-token', [TokenNinjaController::class, 'generateAccessToken']);

Route::post('ninja-tarif', [TokenNinjaController::class, 'ninja_tarif'])->name('ninja_tarif');

Route::group(['middleware' => 'ninja-token'], function(){
    Route::post('/guest/cod/ninja', [CheckoutGuestController::class, 'createCheckout'])->name('guest.ninja.order');
    Route::post('/user/cod/ninja', [CheckoutController::class, 'createCheckout'])->name('user.ninja.order'); 
    Route::get('/confirm/processing/{tracking_number}', [TokenNinjaController::class, 'AWBProcess'])->name('cetak-awb'); 
}); 
