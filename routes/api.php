<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleOrderControllers\SaleOrderPostController;
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


Route::apiResource('invoices', InvoiceController::class);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/request_order_api', \App\Http\Controllers\RequestOrderController::class);

//Route::resource('sale_order', SaleOrderController::class);

Route::post('sale_order', SaleOrderPostController::class);

Route::apiResource('Order', \App\Http\Controllers\PurchaseOrderController::class);
