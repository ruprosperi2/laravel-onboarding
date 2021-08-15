<?php

namespace Src\PurchaseInvoice\Application;

use Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;
use Src\PurchaseInvoice\Domain\FindPurchaseInvoice;


class FindPurchaseInvoiceUseCase
{
    private $finder;

    public function __construct(PurchaseInvoiceRepository $purchaseInvoiceRepository)
    {
        $this->finder = new FindPurchaseInvoice($purchaseInvoiceRepository);
    }

    public function __invoke(int $id)
    {
        $idPurchaseInvoice = new Id($id);

        return $this->finder->__invoke($idPurchaseInvoice);
    }
}
