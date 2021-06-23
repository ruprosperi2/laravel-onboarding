<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use App\Models\Item;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_order = SaleOrder::all();

        return response()->json($sale_order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale_order = new SaleOrder;
        $sale_order->client =  $request->client;
        $sale_order->payment_term = $request->payment_term;
        $sale_order->creation_date = $request->creation_date;
        $sale_order->created_by = $request->created_by;
        $sale_order->state = $request->state;
        $sale_order->observation = $request->observation;

        
        $items = $request->item;


        $sale_order->save();

        foreach($items as $item){
            $sale_order->items()->attach($item);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrder $saleOrder)
    {
        //        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale_order = SaleOrder::find($id);
        $sale_order->client =  $request->client;
        $sale_order->payment_term = $request->payment_term;
        $sale_order->creation_date = $request->creation_date;
        $sale_order->created_by = $request->created_by;
        $sale_order->state = $request->state;
        $sale_order->observation = $request->observation;

        $items = $request->item;

        $sale_order->save();

        $sale_order->items()->sync([$items[0], $items[1]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale_order = SaleOrder::find($id);
        $sale_order->delete();
        $sale_order->items()->detach();
    }
}
