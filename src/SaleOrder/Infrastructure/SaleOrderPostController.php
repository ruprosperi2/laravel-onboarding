<?php 
namespace Src\SaleOrder\Infrastructure;

use Illuminate\Http\Request;
use Src\SaleOrder\Application\CreateSaleOrderUseCase;
use Src\SaleOrder\Infrastructure\Repositories\EloquentSaleOrderRepository;

final class SaleOrderPostController
{
    private $repository;

    public function __construct(EloquentSaleOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $saleOrderClient = $request['client'];
        $saleOrderPaymentTerm = $request['payment_term'];
        $saleOrderCreationDate = $request['creation_date'];
        $saleOrderCreatedBy = $request['created_by'];
        $saleOrderState = $request['state'];
        $saleOrderObservation = $request['observation'];
        $saleOrderItems = $request['items'];

        $createSaleOrderUseCase = new CreateSaleOrderUseCase($this->repository);
        $createSaleOrderUseCase->__invoke(
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