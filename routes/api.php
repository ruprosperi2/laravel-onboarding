<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleOrderControllers\SaleOrderPostController;
use App\Http\Controllers\SaleOrderControllers\SaleOrderPutController;
use App\Http\Controllers\SaleOrderControllers\SaleOrderDeleteController;
use App\Http\Controllers\SaleOrderControllers\SaleOrderGetController;
use App\Http\Controllers\SaleOrderControllers\SaleOrderAllGetController;

use App\Http\Controllers\InvoiceControllers\InvoiceGetAllController;
use App\Http\Controllers\InvoiceControllers\InvoiceGetController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/request_order_api', \App\Http\Controllers\RequestOrderController::class);

Route::get('sale_order', SaleOrderAllGetController::class);

Route::post('sale_order', SaleOrderPostController::class);

Route::get('sale_order/{id}', SaleOrderGetController::class);

Route::put('sale_order/{id}', SaleOrderPutController::class);

Route::delete('sale_order/{id}', SaleOrderDeleteController::class);

Route::apiResource('Order', \App\Http\Controllers\PurchaseOrderController::class);

/*Facturas de Compra*/
Route::get('invoices', InvoiceGetAllController::class);

Route::get('invoice/{id}', InvoiceGetController::class);
