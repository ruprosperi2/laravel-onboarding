<?php

namespace Src\PurchaseInvoice\Infrastructure\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\PurchaseInvoice\Application\UpdatePurchaseInvoiceUseCase;

class PurchaseInvoicePutController extends Controller
{
    private $useCase;

    public function __construct(UpdatePurchaseInvoiceUseCase $purchaseInvoiceUseCase)
    {
        $this->useCase = $purchaseInvoiceUseCase;
    }

    public function __invoke(int $id, Request $request)
    {
        $this->useCase->__invoke($id, $request);
    }
}
