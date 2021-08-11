<?php

namespace Src\PurchaseInvoice\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;
use Src\PurchaseInvoice\Domain\PurchaseInvoice;

class PurchaseInvoiceMysqlRepository implements PurchaseInvoiceRepository
{
    public function findAll(): object
    {
        return $result = DB::table('invoices')->get();

    }

    public function find(Id $id): PurchaseInvoice
    {
        $row = DB::table('invoices')->where('id', '=', $id->value())->get();

        dd(count($row));

       /* return new SaleOrder(
            new Client($saleOrder->client),
            new PaymentTerm($saleOrder->payment_term),
            new CreationDate($saleOrder->creation_date),
            new CreatedBy($saleOrder->created_by),
            new State($saleOrder->state),
            new Observation($saleOrder->observation),
            new Items(json_decode(json_encode($saleOrder->items), true))
        );*/
    }
}
