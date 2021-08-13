<?php

namespace Src\PurchaseInvoice\Infrastructure\Controller;

use Src\PurchaseInvoice\Application\FindPurchaseInvoiceUseCase;


class PurchaseInvoiceGetController
{
    private $useCase;

    public function __construct(FindPurchaseInvoiceUseCase $findPurchaseInvoiceUseCase)
    {
        $this->useCase = $findPurchaseInvoiceUseCase;
    }

    public function __invoke(int $id)
    {
        return response($this->useCase->__invoke($id),200);
    }
}
