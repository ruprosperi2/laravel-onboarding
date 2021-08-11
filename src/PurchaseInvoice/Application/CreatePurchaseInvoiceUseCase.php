<?php

namespace Src\PurchaseInvoice\Application;

use Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Supplier;
use Src\PurchaseInvoice\Domain\ValueObjects\Payterm;
use Src\PurchaseInvoice\Domain\ValueObjects\DateCreation;
use Src\PurchaseInvoice\Domain\ValueObjects\Status;
use Src\PurchaseInvoice\Domain\ValueObjects\Created;
use Src\PurchaseInvoice\Domain\ValueObjects\Observations;
use Src\PurchaseInvoice\Domain\ValueObjects\Items;
use Src\PurchaseInvoice\Domain\PurchaseInvoice;

class CreatePurchaseInvoiceUseCase
{
    private $repository;

    public function __construct(PurchaseInvoiceRepository $purchaseInvoiceRepository)
    {
        $this->repository = $purchaseInvoiceRepository;
    }

    public function __invoke($body)
    {
        $supplier = new  Supplier($body['supplier']);
        $pay_term = new Payterm($body['pay_term']);
        $date = new DateCreation($body['date']);
        $created = new Created($body['created']);
        $status = new Status($body['status']);
        $observations = new Observations($body['observations']);
        $items = new Items($body['items']);

        $purchaseInvoice = PurchaseInvoice::create($supplier, $pay_term, $date, $created, $status, $observations, $items);

        $this->repository->save($purchaseInvoice);

    }
}
