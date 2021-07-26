<?php 
namespace Src\SaleOrder\Infrastructure;

use Illuminate\Http\Request;
use Src\SaleOrder\Application\DeleteSaleOrderUseCase;
use Src\SaleOrder\Infrastructure\Repositories\EloquentSaleOrderRepository;

final class SaleOrderDeleteController
{
    private $repository;

    public function __construct(EloquentSaleOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $saleOrderId = (int)$request->id;

        $createSaleOrderUseCase = new DeleteSaleOrderUseCase($this->repository);
        $createSaleOrderUseCase->__invoke($saleOrderId);
    }
}

?>