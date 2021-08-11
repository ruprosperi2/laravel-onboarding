<?php

namespace Src\PurchaseInvoice\Application;

use Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;

class FindPurchaseInvoiceUseCase
{
    private $repository;

    public function __construct(PurchaseInvoiceRepository $purchaseInvoiceRepository)
    {
        $this->repository = $purchaseInvoiceRepository;
    }

    public function __invoke(int $id)
    {
        $idPurchaseInvoice = new Id($id);

        return $this->repository->find($idPurchaseInvoice);
    }
}
