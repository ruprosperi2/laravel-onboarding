<?php


namespace App\Http\Controllers\PurchaseOrderController;


use App\Models\PurchaseOrder;

class PurchaseOrderDeleteController
{
    public function __invoke($id)
    {

        PurchaseOrder::with('itemsTable')->find($id)->delete();

        return response()->json("El registro indicado ha sido eliminado");
    }
}
