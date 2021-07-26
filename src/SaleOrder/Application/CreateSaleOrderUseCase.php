<?php 

namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderClient;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderPaymentTerm;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreationDate;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderCreatedBy;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderState;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderObservation;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderItems;

final class CreateSaleOrderUseCase
{
    private $repository;

    public function __construct(SaleOrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $saleOrderClient,
        string $saleOrderPaymentTerm,
        string $saleOrderCreationDate,
        string $saleOrderCreatedBy,
        string $saleOrderState,
        string $saleOrderObservation,
        array $saleOrderItems
    ): void
    {
        $client = new SaleOrderClient($saleOrderClient);
        $paymentTerm = new SaleOrderPaymentTerm($saleOrderPaymentTerm);
        $creationDate = new SaleOrderCreationDate($saleOrderCreationDate);
        $createdBy = new SaleOrderCreatedBy($saleOrderCreatedBy);
        $state = new SaleOrderState($saleOrderState);
        $observation = new SaleOrderObservation($saleOrderObservation);
        $items = new SaleOrderItems($saleOrderItems);

        $saleOrder = SaleOrder::create($client, $paymentTerm, $creationDate, $createdBy, $state, $observation, $items);

        $this->repository->save($saleOrder);
    }
}