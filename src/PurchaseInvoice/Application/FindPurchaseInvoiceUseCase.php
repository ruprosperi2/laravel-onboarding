<?php

namespace Src\PurchaseInvoice\Application;

use Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;
use Src\PurchaseInvoice\Domain\ValueObjects\Items;
use Src\PurchaseInvoice\Domain\ValueObjects\Supplier;
use Src\PurchaseInvoice\Domain\ValueObjects\Payterm;
use Src\PurchaseInvoice\Domain\ValueObjects\DateCreation;
use Src\PurchaseInvoice\Domain\ValueObjects\Created;
use Src\PurchaseInvoice\Domain\ValueObjects\Status;
use Src\PurchaseInvoice\Domain\ValueObjects\Observations;
use Src\PurchaseInvoice\Domain\PurchaseInvoice;

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

        $rows=  json_decode($this->repository->find($idPurchaseInvoice), true);

        $purchaseInvoiceItems = [];

        for($i=0; $i<count($rows); $i++){
            $purchaseInvoiceItems[$i]['name'] = $rows[$i]['name'];
            $purchaseInvoiceItems[$i]['amount'] = $rows[$i]['amount'];
            $purchaseInvoiceItems[$i]['price'] = $rows[$i]['price'];
            $purchaseInvoiceItems[$i]['subtotal'] = $rows[$i]['subtotal'];
            $purchaseInvoiceItems[$i]['invoice_id'] = $rows[$i]['invoice_id'];
        }

        //$items = new Items($purchaseInvoiceItems);

        $invoice = [];

        foreach ($rows as $item){
            $invoice['supplier'] =  $item['supplier'];
            $invoice['pay_term'] = $item['pay_term'];
            $invoice['date'] = $item['date'];
            $invoice['created'] = $item['created'];
            $invoice['status'] = $item['status'];
            $invoice['observations'] = $item['observations'];
            $invoice['items'] = $purchaseInvoiceItems;
        }

        return $invoice;
    }
}
