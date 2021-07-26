<?php 
namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;

final class AllGetSaleOrderUseCase
{
	private $repository;

	public function __construct(SaleOrderRepositoryContract $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke()
	{
		$saleOrder = $this->repository->findAll();

		return $saleOrder;
	}
}

?>