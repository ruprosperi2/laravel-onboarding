<?php

namespace Src\SaleOrder\Infrastructure\Repositories;

use App\Models\SaleOrder as EloquentSaleOrderModel;
use App\Models\OrderItem as EloquentItemModel;
use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderClient;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderPaymentTerm;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreationDate;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreatedBy;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderState;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderObservation;

final class EloquentSaleOrderRepository implements SaleOrderRepositoryContract
{
    private $eloquentSaleOrderModel;
    private $item;

    public function __construct()
    {
        $this->eloquentSaleOrderModel = new EloquentSaleOrderModel;
    }

    public function save(SaleOrder $saleOrder): void
    {
        $data = [
            'client' => $saleOrder->client()->value(),
            'payment_term' => $saleOrder->paymentTerm()->value(),
            'creation_date' => $saleOrder->creationDate()->value(),
            'created_by' => $saleOrder->createdBy()->value(),
            'state' => $saleOrder->state()->value(),
            'observation' => $saleOrder->observation()->value(),
        ];

        $newSaleOrder = $this->eloquentSaleOrderModel->create($data);

        $saleOrderItems = [];
        
        foreach($saleOrder->items()->value() as $item)
        {
            $saleOrderItems[] = new EloquentItemModel($item);
        }

        $newSaleOrder->items()->saveMany($saleOrderItems);
    }
}