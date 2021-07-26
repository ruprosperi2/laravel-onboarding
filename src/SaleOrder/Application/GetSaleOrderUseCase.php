<?php 
namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;
use Src\SaleOrder\Domain\SaleOrder;

final class GetSaleOrderUseCase
{
	private $repository;

	public function __construct(SaleOrderRepositoryContract $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(int $saleOrderId): ?SaleOrder
	{
		$id = new SaleOrderId($saleOrderId);

		$saleOrder = $this->repository->find($id);

		return $saleOrder;
	}
}

?>