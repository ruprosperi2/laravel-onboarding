<?php


namespace App\Http\Controllers\PurchaseOrderController;

use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseOrderUpdateController
{
    public function __invoke(Request $request, $id)
    {

        $date = Carbon::now();

        $dataOrder = PurchaseOrder::find($id);

        $dataOrder->date = $date;
        $dataOrder->created_by = $request->created_by;
        $dataOrder->supplier = $request->supplier;
        $dataOrder->payment_term = $request->payment_term;
        $dataOrder->status = $request->status;
        $dataOrder->observations = $request->observations;

        $dataOrder->save();

        $itemsPurchase = [];

        foreach ($request->dataItems as $dataItems) {

            $items = PurchaseItem::find($dataItems["id"]);

            if (empty($items)) {

                $itemsPurchase[] = new PurchaseItem($dataItems);

            } else {

                $items->product_name = $dataItems["product_name"];
                $items->amount = $dataItems["amount"];
                $items->price = $dataItems["price"];
                $items->subtotal = $dataItems["subtotal"];

                $items->save();
            }

        }

        $dataOrder->itemsTable()->saveMany($itemsPurchase);

        return response()->json("Los datos han sido actualizados exitosamente");

    }
}
