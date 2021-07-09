<?php 
namespace App\Repositories;

use App\Models\SaleOrder;
use App\Models\OrderItem;
use App\Repositories\Interfaces\SaleOrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
class SaleOrderRepository implements SaleOrderRepositoryInterface
{
	protected $saleOrder;

	public function __construct(SaleOrder $saleOrder)
	{
		$this->saleOrder = $saleOrder;
	}

	public function create($request)
	{
		DB::transaction(function () use ($request){
			$sale_order = $this->saleOrder::create($request->all());
			
			$order_items = collect($request->items)->map(function($item){
				return new OrderItem($item);
			});
			
			$sale_order->items()->saveMany($order_items);
		});
	}

	public function read()
	{
		$items_sale_orders = $this->saleOrder::with('items')->get();
        return response()->json($items_sale_orders);
	}

	public function update($request, $id)
	{
		DB::transaction(function () use ($request, $id){
            $this->saleOrder::find($id)->update($request->except('items'));
            
            foreach($request->items as $items){
                OrderItem::updateOrCreate(['id' => $items['id']], $items);
            }
        });
	}

	public function delete($id)
	{
		$this->saleOrder::find($id)->delete();
	}

	public function readById($id)
	{
		$items_sale_orders = $this->saleOrder::with('items')->find($id);
        return response()->json($items_sale_orders);
	}
}


?>