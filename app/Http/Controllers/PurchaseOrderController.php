<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PurchaseOrderController extends Controller
{
    public function index()
    {
        $dataPurchaseOrders = PurchaseOrder::with('itemsTable')->get();

        return response()->json($dataPurchaseOrders);
    }

    public function store(Request $request)
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

            $itemsPurchase[] = new OrderItem($dataItems);

            $dataOrder->itemsTable()->saveMany($itemsPurchase);

        }

        return response()->json($request);
    }

    public function show($id)
    {

        $dataOrder = PurchaseOrder::with('itemsTable')->find($id);

        return response()->json($dataOrder);
    }

    public function update(Request $request, $id)
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

            $items = OrderItem::find($dataItems["id"]);

            if (empty($items)) {

                $itemsPurchase[] = new OrderItem($dataItems);

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

    public function delete($id){

        PurchaseOrder::with('itemsTable')->find($id)->delete();

        return response()->json("El registro indicado ha sido eliminado");
    }
}
