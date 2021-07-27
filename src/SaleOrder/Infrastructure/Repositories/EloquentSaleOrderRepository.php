<?php

namespace Src\SaleOrder\Infrastructure\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\SaleOrder as EloquentSaleOrderModel;
use App\Models\OrderItem as EloquentItemModel;
use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Shared\Domain\ValueObject\Id;
use Shared\Domain\ValueObject\Client;
use Shared\Domain\ValueObject\PaymentTerm;
use Shared\Domain\ValueObject\CreationDate;
use Shared\Domain\ValueObject\CreatedBy;
use Shared\Domain\ValueObject\State;
use Shared\Domain\ValueObject\Observation;
use Shared\Domain\ValueObject\Items;

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
        DB::transaction(function () use ($saleOrder){
           $data = [
            'client' => $saleOrder->client()->value(),
            'payment_term' => $saleOrder->paymentTerm()->value(),
            'creation_date' => $saleOrder->creationDate()->value(),
            'created_by' => $saleOrder->createdBy()->value(),
            'state' => $saleOrder->state()->value(),
            'observation' => $saleOrder->observation()->value(),
            ];

            $newSaleOrder = $this->eloquentSaleOrderModel->create($data);

            $saleOrderItems = collect($saleOrder->items()->value())->map(function($item){
				return new EloquentItemModel($item);
			});

            $newSaleOrder->items()->saveMany($saleOrderItems); 
        });
    }

    public function find(Id $id): ?SaleOrder
    {
        $saleOrder = $this->eloquentSaleOrderModel->findOrFail($id->value());

        return new SaleOrder(
            new Client($saleOrder->client),
            new PaymentTerm($saleOrder->payment_term),
            new CreationDate($saleOrder->creation_date),
            new CreatedBy($saleOrder->created_by),
            new State($saleOrder->state),
            new Observation($saleOrder->observation),
            new Items(json_decode(json_encode($saleOrder->items), true))
        );
    }

    public function findAll(): object
    {
        return $this->eloquentSaleOrderModel->with('items')->get();
    }

    public function update(Id $id, SaleOrder $saleOrder): void
    {
        DB::transaction(function () use ($id, $saleOrder){
           
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
        });
    }

    public function delete(Id $id): void
    {
        $this->eloquentSaleOrderModel->findOrFail($id->value())->delete();
    }
}