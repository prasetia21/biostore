<?php

use App\Http\Controllers\Api\TesController;
use App\Http\Controllers\Api\TokenNinjaController;
use App\Http\Controllers\Api\WebhookController;
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




Route::post('/webhook/cancelled', [WebhookController::class, 'cancelled']);
Route::post('/webhook/pending-pickup', [WebhookController::class, 'pending_pickup']);
Route::post('/webhook/success-pickup', [WebhookController::class, 'success_pickup']);
Route::post('/webhook/fail-pickup', [WebhookController::class, 'fail_pickup']);

Route::post('/webhook/receive_pending_reschedule', [WebhookController::class, 'receive_pending_reschedule']);
Route::post('/webhook/rts', [WebhookController::class, 'rts']);
Route::post('/webhook/returned_to_senders', [WebhookController::class, 'returned_to_senders']);
Route::post('/webhook/returned_to_senders_trigger', [WebhookController::class, 'returned_to_senders_trigger']);

Route::post('/webhook/en_route_sorting_hub', [WebhookController::class, 'en_route_sorting_hub']);
Route::post('/webhook/arrive_sorting_hub', [WebhookController::class, 'arrive_sorting_hub']);
Route::post('/webhook/on_vehiche_delivery', [WebhookController::class, 'on_vehiche_delivery']);
Route::post('/webhook/arrive_distribution_point', [WebhookController::class, 'arrive_distribution_point']);
Route::post('/webhook/selesai', [WebhookController::class, 'selesai']);
Route::post('/webhook/pengiriman_berhasil', [WebhookController::class, 'pengiriman_berhasil']);

Route::post('/webhook/pending_reschedule', [WebhookController::class, 'pending_reschedule']);
Route::post('/webhook/delivery_fail', [WebhookController::class, 'delivery_fail']);
Route::post('/webhook/delivery_rts', [WebhookController::class, 'delivery_rts']);

Route::post('/webhook/berat_paket', [WebhookController::class, 'berat_paket']);




Route::group(['middleware' => 'ninja-token'], function(){
    Route::post('/guest/cod/ninja', [CheckoutGuestController::class, 'createCheckout'])->name('guest.ninja.order');
    Route::post('/user/cod/ninja', [CheckoutController::class, 'createCheckout'])->name('user.ninja.order'); 
    Route::get('/confirm/processing/{tracking_number}', [TokenNinjaController::class, 'AWBProcess'])->name('cetak-awb'); 
}); 
