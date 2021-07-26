<?php 
namespace Src\SaleOrder\Infrastructure;

use Illuminate\Http\Request;
use Src\SaleOrder\Application\GetSaleOrderUseCase;
use Src\SaleOrder\Infrastructure\Repositories\EloquentSaleOrderRepository;

final class SaleOrderGetController
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

        return $saleOrder;
    }
}

?>