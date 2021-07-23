<?php

namespace Src\SaleOrder\Infrastructure\Repositories;

use App\Models\SaleOrder as EloquentSaleOrderModel;
use App\Models\OrderItem as EloquentItemModel;
use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Src\SaleOrder\Domain\Item;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderClient;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderPaymentTerm;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreationDate;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreatedBy;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderState;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderObservation;
use Src\SaleOrder\Domain\ValueObjects\ItemName;
use Src\SaleOrder\Domain\ValueObjects\ItemAmount;
use Src\SaleOrder\Domain\ValueObjects\ItemPrice;
use Src\SaleOrder\Domain\ValueObjects\ItemSubTotal;

final class EloquentSaleOrderRepository implements SaleOrderRepositoryContract
{
    private $eloquentSaleOrderModel;
    private $eloquentItemModel;

    public function __construct()
    {
        $this->eloquentSaleOrderModel = new EloquentSaleOrderModel;
        $this->eloquentItemModel = new EloquentItemModel;
    }

    public function save(SaleOrder $saleOrder): void
    {
        $newSaleOrder = $this->eloquentSaleOrderModel;
        
        $data = [
            'client' => $saleOrder->client()->value(),
            'payment_term' => $saleOrder->paymentTerm()->value(),
            'creation_date' => $saleOrder->creationDate()->value(),
            'created_by' => $saleOrder->createdBy()->value(),
            'state' => $saleOrder->state()->value(),
            'observation' => $saleOrder->observation()->value()
        ];

        $newSaleOrder->create($data);
    }

    public function saveItem(Item $item): void
    {
        $newItem = $this->eloquentItemModel;

        $data = [
            'name' => $item->name()->value(),
            'amount' => $item->amount()->value(),
            'price' => $item->price()->value(),
            'sub_total' => $item->subTotal()->value(),
            'sale_order_id' => $item->saleOrderId()->value()
        ];

        $newItem->create($data);
    }
}