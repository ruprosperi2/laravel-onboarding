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
        $dataRequestOrder=RequestOrder::all();
        return response()->json($dataRequestOrder);
    }


    public function store(Request $request)
    {
        $date = Carbon::now();

        $dataRequestOrder=new RequestOrder();

        $dataRequestOrder->date=$date;
        $dataRequestOrder->created_by=$request->created_by;
        $dataRequestOrder->status=$request->status;
        $dataRequestOrder->observations=$request->observations;

        $dataRequestOrder->save();

        $itemsrequest=[];
        foreach ($request->itemsRequests as  $itemsRequest){
            $itemsRequest[]=new ItemsRequest($itemsrequest);
        }
        $dataRequestOrder->itemsRequests()->saveMany($itemsrequest);

        return response()->json($request);
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
