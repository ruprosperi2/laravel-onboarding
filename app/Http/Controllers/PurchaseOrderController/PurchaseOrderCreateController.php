<?php

namespace App\Http\Controllers\PurchaseOrderController;

use App\Http\Controllers\Controller;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseOrderCreateController extends Controller
{
    public function __invoke(Request $request)
    {

        $date = Carbon::now();

        $dataOrder = new PurchaseOrder();

        $dataOrder->date = $date;
        $dataOrder->created_by = $request->created_by;
        $dataOrder->supplier = $request->supplier;
        $dataOrder->payment_term = $request->payment_term;
        $dataOrder->status = $request->status;
        $dataOrder->observations = $request->observations;

        $dataOrder->save();

        $itemsPurchase = [];

        foreach ($request->dataItems as $dataItems) {

            $itemsPurchase[] = new PurchaseItem($dataItems);

            $dataOrder->itemsTable()->saveMany($itemsPurchase);

        }

        return response()->json($request);
    }
}
