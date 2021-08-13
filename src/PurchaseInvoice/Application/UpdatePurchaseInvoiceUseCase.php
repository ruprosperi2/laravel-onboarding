<?php

namespace Src\PurchaseInvoice\Application;

use Illuminate\Support\Arr;
use Src\PurchaseInvoice\Infrastructure\Repository\PurchaseInvoiceMysqlRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;
use Src\PurchaseInvoice\Domain\ValueObjects\Supplier;
use Src\PurchaseInvoice\Domain\ValueObjects\Payterm;
use Src\PurchaseInvoice\Domain\ValueObjects\DateCreation;
use Src\PurchaseInvoice\Domain\ValueObjects\Status;
use Src\PurchaseInvoice\Domain\ValueObjects\Created;
use Src\PurchaseInvoice\Domain\ValueObjects\Observations;
use Src\PurchaseInvoice\Domain\ValueObjects\Items;
use Src\PurchaseInvoice\Domain\PurchaseInvoice;

use Src\PurchaseInvoice\Application\FindPurchaseInvoiceUseCase;


class UpdatePurchaseInvoiceUseCase
{
    private $repository;

    public function __construct(PurchaseInvoiceMysqlRepository $purchaseInvoiceMysqlRepository)
    {
        $this->repository = $purchaseInvoiceMysqlRepository;
    }

    public function __invoke(int $id, $body)
    {

        $getPurchaseInvoice = new FindPurchaseInvoiceUseCase($this->repository);

        $row = $getPurchaseInvoice->__invoke($id);

        $idItems = head(Arr::pluck($row['items'], 'invoice_id'));

        $id = new Id($idItems);

        $supplier = new  Supplier($body['supplier']);
        $pay_term = new Payterm($body['pay_term']);
        $date = new DateCreation($body['date']);
        $created = new Created($body['created']);
        $status = new Status($body['status']);
        $observations = new Observations($body['observations']);
        $items = new Items($body['items']);

        $purchaseInvoice = PurchaseInvoice::create($supplier, $pay_term, $date, $created, $status, $observations, $items);

        $purchaseInvoiceUpdate = $this->repository->update($id, $purchaseInvoice);

    }
}
