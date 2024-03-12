<?php

use App\Http\Controllers\Api\TesController;
use App\Http\Controllers\Api\TokenNinjaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Guest\User\CheckoutGuestController;
use App\Http\Controllers\User\MidtransController;
use App\Http\Controllers\Guest\User\MidtransGuestController;
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

Route::get('tes/{id}', [TesController::class, 'index']);
Route::post('pos', [TesController::class, 'posting']);

Route::post('generate-token', [TokenNinjaController::class, 'generateAccessToken']);

Route::post('ninja-tarif', [TokenNinjaController::class, 'ninja_tarif'])->name('ninja_tarif');
Route::post('ninja-create-order', [TokenNinjaController::class, 'ninja_create_order'])->name('ninja_create_order');

Route::group(['middleware' => 'ninja-token'], function(){
    Route::get('tes/{id}', [TesController::class, 'index']);
    Route::post('/cod/ninja', [CheckoutGuestController::class, 'createCheckout'])->name('cash.ninja.order');
    
    
}); 




Route::post('/order/ninja', [TokenNinjaController::class, 'ninja_order_tes'])->name('api.ninja');
