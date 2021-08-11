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

        $row = DB::table('invoices')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->select('invoices.*', 'invoice_items.*')
            ->where('invoices.id', '=', $id->value())
            ->groupBy()
            ->get();

        dd($row);

        return new PurchaseInvoice(
            new Supplier($saleOrder->client),
            new Payterm($saleOrder->payment_term),
            new DateCreation($saleOrder->creation_date),
            new Created($saleOrder->created_by),
            new Status($saleOrder->state),
            new Observations($saleOrder->observation),
            new Items(json_decode(json_encode($saleOrder->items), true))
        );

    }
}
