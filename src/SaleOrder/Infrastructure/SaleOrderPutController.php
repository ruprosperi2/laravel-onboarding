<?php 
namespace Src\SaleOrder\Infrastructure;

use Illuminate\Http\Request;
use Src\SaleOrder\Application\GetSaleOrderUseCase;
use Src\SaleOrder\Application\UpdateSaleOrderUseCase;
use Src\SaleOrder\Infrastructure\Repositories\EloquentSaleOrderRepository;

final class SaleOrderPutController
{
    private $repository;

    public function __construct(EloquentSaleOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $saleOrderId = (int)$request->id;

        $getSaleOrderUseCase = new GetSaleOrderUseCase($this->repository);

        $saleOrder = $getSaleOrderUseCase->__invoke($saleOrderId);

        $saleOrderClient = $request['client'] ?? $saleOrder->client()->value();
        $saleOrderPaymentTerm = $request['payment_term'] ?? $saleOrder->paymentTerm()->value();
        $saleOrderCreationDate = $request['creation_date'] ?? $saleOrder->creationDate()->value();
        $saleOrderCreatedBy = $request['created_by'] ?? $saleOrder->createdBy()->value();
        $saleOrderState = $request['state'] ?? $saleOrder->state()->value();
        $saleOrderObservation = $request['observation'] ?? $saleOrder->observation()->value();
        $saleOrderItems = $request['items'] ?? $saleOrder->items()->value();

        $createSaleOrderUseCase = new UpdateSaleOrderUseCase($this->repository);
        $createSaleOrderUseCase->__invoke(
            $saleOrderId,
            $saleOrderClient,
            $saleOrderPaymentTerm,
            $saleOrderCreationDate,
            $saleOrderCreatedBy,
            $saleOrderState,
            $saleOrderObservation,
            $saleOrderItems
        );
    }
}

?>