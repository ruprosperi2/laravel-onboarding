<?php 
namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;

final class DeleteSaleOrderUseCase
{
	private $repository;

	public function __construct(SaleOrderRepositoryContract $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(int $saleOrderId): void
	{
		$id = new SaleOrderId($saleOrderId);

		$saleOrder = $this->repository->delete($id);
	}
}

?>