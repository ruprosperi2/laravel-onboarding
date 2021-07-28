<?php


namespace App\Http\Controllers\PurchaseOrderController;

use App\Models\PurchaseOrder;

class PurchaseOrderReadOneController
{
    public function __invoke($id)
    {

        $dataOrder = PurchaseOrder::with('itemsTable')->find($id);

        return response()->json($dataOrder);
    }
}
