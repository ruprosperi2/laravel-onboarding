<?php 
namespace Src\SaleOrder\Infrastructure;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
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
        $saleOrderClient = $request->input('client');
        $saleOrderPaymentTerm = $request->input('payment_term');
        $saleOrderCreationDate = $request->input('creation_date');
        $saleOrderCreatedBy = $request->input('created_by');
        $saleOrderState = $request->input('state');
        $saleOrderObservation = $request->input('observation');

/*THERE IS TO CREATE THE USE CASE FOR THE SALE ORDER DOWN HERE*/
        $createSaleOrderUseCase = new CreateSaleOrderUseCase($this->repository);
        $createSaleOrderUseCase->__invoke(
            $saleOrderClient,
            $saleOrderPaymentTerm,
            $saleOrderCreationDate,
            $saleOrderCreatedBy,
            $saleOrderState,
            $saleOrderObservation
        );

        /*

		$getUserByCriteriaUseCase = new GetUserByCriteriaUseCase($this->repository);
        $newUser                  = $getUserByCriteriaUseCase->__invoke($userName, $userEmail);

        return $newUser;
        */
    }
}

?>