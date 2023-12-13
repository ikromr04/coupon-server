<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('/auth/login', [AuthController::class, 'check']);
  Route::delete('/auth/logout', [AuthController::class, 'logout']);

  Route::put('/coupons', [CouponController::class, 'use']);
});
