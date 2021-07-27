<?php 
namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Shared\Domain\ValueObject\Id;
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
		$id = new Id($saleOrderId);

		$saleOrder = $this->repository->find($id);

		return $saleOrder;
	}
}

?>