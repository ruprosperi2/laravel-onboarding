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
            $invoice['supplier'] =  new Supplier($item['supplier']);
            $invoice['pay_term'] = new Payterm($item['pay_term']);
            $invoice['date'] = new DateCreation($item['date']);
            $invoice['created'] = new Created($item['created']);
            $invoice['status'] = new Status($item['status']);
            $invoice['observations'] = new Observations($item['observations']);
            $invoice['items'] = $purchaseInvoiceItems;
        }

        $purchaseInvoice = PurchaseInvoice::create( $invoice['supplier'], $invoice['pay_term'], $invoice['date'], $invoice['created'], $invoice['status'], $invoice['observations'], $invoice['items']);

        return $purchaseInvoice;
    }
}
