<?php

namespace Src\PurchaseInvoice\Infrastructure\Controller;

use Illuminate\Routing\Controller;
use Src\PurchaseInvoice\Application\FindAllPurchaseInvoiceUseCase;

class PurchaseInvoiceAllGetController extends Controller
{
    private $controller;

    public function __construct(FindAllPurchaseInvoiceUseCase $findAllPurchaseInvoiceUseCase)
    {
        $this->controller = $findAllPurchaseInvoiceUseCase;
    }

    public function __invoke()
    {
        return $this->controller->__invoke();
    }
}
