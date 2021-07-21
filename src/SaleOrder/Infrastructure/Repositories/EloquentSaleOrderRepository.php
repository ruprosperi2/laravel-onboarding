<?php

//declare(strict_types=1);

namespace Src\SaleOrder\Infrastructure\Repositories;

use App\Models\SaleOrder as EloquentSaleOrderModel;
use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderClient;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderPaymentTerm;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreationDate;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreatedBy;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderState;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderObservation;

final class EloquentSaleOrderRepository implements SaleOrderRepositoryContract
{
    private $eloquentSaleOrderModel;

    public function __construct()
    {
        $this->eloquentSaleOrderModel = new EloquentSaleOrderModel;
    }

    /*
    public function find(SaleOrderId $id): ?SaleOrder
    {
        $saleOrder = $this->eloquentSaleOrderModel->findOrFail($id->value());

        // Return Domain User model
        return new SaleOrder(
            new SaleOrderClient($saleOrder->client),
            new SaleOrderPaymentTerm($saleOrder->payment_term),
            new SaleOrderCreationDate($saleOrder->creation_date),
            new SaleOrderCreatedBy($saleOrder->created_by),
            new SaleOrderObservation($saleOrder->observation),
            new SaleOrderState($saleOrder->state)
        );
    }
    */


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
}