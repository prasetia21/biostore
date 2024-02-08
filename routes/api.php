<?php

use App\Http\Controllers\Api\TesController;
use App\Http\Controllers\Api\TokenNinjaController;
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

Route::group(['middleware' => 'check-token'], function(){
    Route::get('tes/{id}', [TesController::class, 'index']);
}); 
