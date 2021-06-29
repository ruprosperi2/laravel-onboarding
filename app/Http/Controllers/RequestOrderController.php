<?php

namespace App\Http\Controllers;

use App\Models\ItemsRequest;
use App\Models\RequestOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RequestOrderController extends Controller
{

    public function index()
    {
        $dataRequestOrder = RequestOrder::with('itemsRequests')->get();
        return response()->json($dataRequestOrder);
    }


    public function store(Request $request)
    {
        $date = Carbon::now();

        $dataRequestOrder = new RequestOrder();

        $dataRequestOrder->date = $date;
        $dataRequestOrder->created_by = $request->created_by;
        $dataRequestOrder->status = $request->status;
        $dataRequestOrder->observations = $request->observations;

        $dataRequestOrder->save();

        $itemsR = [];

        foreach ($request->itemsRequests as $itemsRequests) {

            $itemsR[] = new ItemsRequest($itemsRequests);
        }
        $dataRequestOrder->itemsRequests()->saveMany($itemsR);

        return response("the request has been created");
    }


    public function show($id)
    {
        $dataRequestOrder = RequestOrder::with('itemsRequests')->find($id);
        return response()->json($dataRequestOrder);

    }

    public function update(Request $request, $id)
    {
        $date = Carbon::now();
        $dRequestOrder = RequestOrder::find($id);
        $dRequestOrder->date = $date;
        $dRequestOrder->created_by = $request->created_by;
        $dRequestOrder->status = $request->status;
        $dRequestOrder->observations = $request->observations;

        $dRequestOrder->save();

        $itemsR = [];

        foreach ($request->itemsReq as $itemsReq) {

            $dataItems = ItemsRequest::find($itemsReq["id"]);

            if (empty($dataItems)) {
                $itemsR[] = new ItemsRequest($itemsReq);

            } else {
                $dataItems->product_name = $itemsReq["product_name"];
                $dataItems->amount = $itemsReq["amount"];
                $dataItems->save();
            }
        }
        $dRequestOrder->itemsRequests()->saveMany($itemsR);

        return response("the request has been updated");
    }

    public function destroy($id)
    {
        $deleteRequestOrder = RequestOrder::with('itemsRequests')->find($id);
        $deleteRequestOrder->destroy($id);
        return response("the request with the id ${id} has been deleted");
    }

}
