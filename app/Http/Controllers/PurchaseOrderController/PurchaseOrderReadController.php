<?php


namespace App\Http\Controllers\PurchaseOrderController;


use App\Models\PurchaseOrder;


class PurchaseOrderReadController
{
    public function __invoke()
    {
        $dataPurchaseOrders = PurchaseOrder::with('itemsTable')->get();

        return response()->json($dataPurchaseOrders);
    }
}
