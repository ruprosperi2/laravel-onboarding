<?php

namespace Src\SaleOrder\Infrastructure\Repositories;

use Illuminate\Support\Arr;
use App\Models\SaleOrder as EloquentSaleOrderModel;
use App\Models\OrderItem as EloquentItemModel;
use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderClient;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderPaymentTerm;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreationDate;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreatedBy;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderState;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderObservation;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderItems;

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

    public function find(SaleOrderId $id): ?SaleOrder
    {
        $saleOrder = $this->eloquentSaleOrderModel->findOrFail($id->value());

        return new SaleOrder(
            new SaleOrderClient($saleOrder->client),
            new SaleOrderPaymentTerm($saleOrder->payment_term),
            new SaleOrderCreationDate($saleOrder->creation_date),
            new SaleOrderCreatedBy($saleOrder->created_by),
            new SaleOrderState($saleOrder->state),
            new SaleOrderObservation($saleOrder->observation),
            new SaleOrderItems(json_decode(json_encode($saleOrder->items), true))
        );
    }

    public function update(SaleOrderId $id, SaleOrder $saleOrder): void
    {
        $saleOrderToUpdate = $this->eloquentSaleOrderModel;

        $data = [
            'client' => $saleOrder->client()->value(),
            'payment_term' => $saleOrder->paymentTerm()->value(),
            'creation_date' => $saleOrder->creationDate()->value(),
            'created_by' => $saleOrder->createdBy()->value(),
            'state' => $saleOrder->state()->value(),
            'observation' => $saleOrder->observation()->value()
        ];

        $saleOrderToUpdate->findOrFail($id->value())->update($data);

        $findingItems = EloquentSaleOrderModel::find($id->value());

        $idItem = $findingItems->items->pluck('id')->all();

        $idCompare = Arr::pluck($saleOrder->items()->value(), 'id');

        $notIn = array_values(array_diff($idItem, $idCompare));

        if (!empty($notIn))
            {
                $findingItems->items()->whereIn('id', $notIn)->delete();
            }
        
        foreach($saleOrder->items()->value() as $item)
        {
            EloquentItemModel::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}