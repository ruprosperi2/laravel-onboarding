<?php

namespace Src\PurchaseInvoice\Infrastructure\Controller;

use Illuminate\Routing\Controller;
use Src\PurchaseInvoice\Application\DeletePurchaseInvoiceUseCase;

class PurchaseInvoiceDeleteController extends Controller
{
    private $useCase;

    public function __construct(DeletePurchaseInvoiceUseCase $deletePurchaseInvoiceUseCase)
    {
        $this->useCase = $deletePurchaseInvoiceUseCase;
    }

    public function __invoke(int $id)
    {
        $this->useCase->__invoke($id);
    }
}
