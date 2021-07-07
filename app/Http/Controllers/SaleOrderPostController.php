<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleOrderPostController extends Controller
{
    

    public function __invoke(Request $request){

        $sale_order = SaleOrder::create($request->all());
        $sale_order->save();

        $order_items = [];

        foreach($request->items as $items){
            $order_items[] = new OrderItem($items);
        }

        $sale_order->items()->saveMany($order_items);
    }
}