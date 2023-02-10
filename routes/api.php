<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SaleApiController;
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

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', [AuthController::class, 'login']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::group(['middleware' => 'seller_by_mobile'], function () {
        Route::get('sales', [SaleApiController::class, 'sales']);
        Route::get('sale/{saleId}', [SaleApiController::class, 'sale']);
        Route::post('insert-sale', [SaleApiController::class, 'insertSale']);
        Route::post('insert-sale-roaming', [SaleApiController::class, 'insertSaleRoaming']);
    });
});

Route::any('{path}', function () {
    return response()->json([
        "error" => true,
        'message' => 'Route not found',
        'response' => ['Route not found']
    ], 404);
})->where('path', '.*');
