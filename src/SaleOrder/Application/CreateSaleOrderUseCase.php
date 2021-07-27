<?php 

namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\SaleOrder;
use Shared\Domain\ValueObject\Client;
use Shared\Domain\ValueObject\PaymentTerm;
use Shared\Domain\ValueObject\CreationDate;
use Shared\Domain\ValueObject\CreatedBy;
use Shared\Domain\ValueObject\State;
use Shared\Domain\ValueObject\Observation;
use Shared\Domain\ValueObject\Items;

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
        $client = new Client($saleOrderClient);
        $paymentTerm = new PaymentTerm($saleOrderPaymentTerm);
        $creationDate = new CreationDate($saleOrderCreationDate);
        $createdBy = new CreatedBy($saleOrderCreatedBy);
        $state = new State($saleOrderState);
        $observation = new Observation($saleOrderObservation);
        $items = new Items($saleOrderItems);

        $saleOrder = SaleOrder::create($client, $paymentTerm, $creationDate, $createdBy, $state, $observation, $items);

        $this->repository->save($saleOrder);
    }
}