<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items_sale_orders = SaleOrder::with('items')->get();
        return response()->json($items_sale_orders);
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

        $sale_order = SaleOrder::create($request->all());
        $sale_order->save();

        $order_items = [];

        foreach($request->items as $items){
            $order_items[] = new OrderItem($items);
        }

        $sale_order->items()->saveMany($order_items);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items_sale_orders = SaleOrder::with('items')->find($id);
        return response()->json($items_sale_orders);
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
        DB::transaction(function () use ($request, $id){
            SaleOrder::find($id)->update($request->except('items'));
            
            foreach($request->items as $items){
                OrderItem::updateOrCreate(['id' => $items['id']], $items);
            }
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale_order_id = SaleOrder::find($id);
        $sale_order_id->delete();
    }
}