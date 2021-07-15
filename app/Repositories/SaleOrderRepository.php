<?php 
namespace App\Repositories;

use App\Models\SaleOrder;
use App\Models\OrderItem;
use App\Repositories\Interfaces\SaleOrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
class SaleOrderRepository implements SaleOrderRepositoryInterface
{
	protected $saleOrder;
	protected $orderItem;

	public function __construct(SaleOrder $saleOrder, OrderItem $orderItem)
	{
		$this->saleOrder = $saleOrder;
		$this->orderItem = $orderItem;
	}

	public function create($request)
	{
		return $this->saleOrder->create($request);
	}

	public function createItem($saleOrderId, array $item)
	{
		$orderItem = new OrderItem($item);
		$sale_order = $this->saleOrder::find($saleOrderId);
		return $sale_order->items()->save($orderItem);
	}

	public function read()
	{
		return $this->saleOrder::with('items')->get();
	}

	public function update($data, $id)
	{
		$this->saleOrder::find($id)->update($data);
	}

	public function updateItem(array $item)
	{
		$orderItem = OrderItem::updateOrCreate(['id' => $item['id']], $item);
		
		return $orderItem;
	}

	public function delete($id)
	{
		$this->saleOrder::find($id)->delete();
	}

	public function readById($id)
	{
		return $this->saleOrder::with('items')->find($id);
	}
}


?>