<?php 
namespace Src\SaleOrder\Infrastructure;

use Illuminate\Http\Request;
use Src\SaleOrder\Application\AllGetSaleOrderUseCase;
use Src\SaleOrder\Infrastructure\Repositories\EloquentSaleOrderRepository;

final class SaleOrderAllGetController
{
    private $repository;

    public function __construct(EloquentSaleOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $allGetSaleOrderUseCase = new AllGetSaleOrderUseCase($this->repository);

        $saleOrder = $allGetSaleOrderUseCase->__invoke();
        
        return $saleOrder;
    }
}

?>