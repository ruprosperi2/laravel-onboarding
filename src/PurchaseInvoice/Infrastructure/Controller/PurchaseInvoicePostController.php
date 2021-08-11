<?php

namespace Src\PurchaseInvoice\Infrastructure\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\PurchaseInvoice\Application\CreatePurchaseInvoiceUseCase;

class PurchaseInvoicePostController extends Controller
{
    private $useCase;

    public function __construct(CreatePurchaseInvoiceUseCase $createPurchaseInvoiceUseCase)
    {
        $this->useCase = $createPurchaseInvoiceUseCase;
    }

    public function __invoke(Request $request)
    {
        $this->useCase->__invoke($request);
    }
}
