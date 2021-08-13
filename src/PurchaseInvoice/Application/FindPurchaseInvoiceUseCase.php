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

        $rows=  json_decode($this->repository->find($idPurchaseInvoice), true);

        $purchaseInvoiceItems = [];

        for($i=0; $i<count($rows); $i++){
            $purchaseInvoiceItems[$i]['name'] = $rows[$i]['name'];
            $purchaseInvoiceItems[$i]['amount'] = $rows[$i]['amount'];
            $purchaseInvoiceItems[$i]['price'] = $rows[$i]['price'];
            $purchaseInvoiceItems[$i]['subtotal'] = $rows[$i]['subtotal'];
            $purchaseInvoiceItems[$i]['invoice_id'] = $rows[$i]['invoice_id'];
        }

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
