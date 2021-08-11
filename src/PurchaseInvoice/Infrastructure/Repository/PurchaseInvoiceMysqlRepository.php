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
            ->select('invoices.supplier', 'invoice_items.name')
            ->where('invoices.id', '=', $id->value())
            ->get();

        dd($row);

    }

    public function save(PurchaseInvoice $body): void
    {
        DB::transaction(function () use ($body) {

            $id = DB::table('invoices')->insertGetId(
                [
                    'supplier' => $body->supplier()->value(),
                    'pay_term' => $body->payTerm()->value(),
                    'date' => $body->date()->value(),
                    'created' => $body->created()->value(),
                    'status' => $body->status()->value(),
                    'observations' => $body->observations()->value(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );

            $invoiceItem = [];

            foreach ($body->items()->value() as $item) {
                $invoiceItem['name'] = $item['name'];
                $invoiceItem['amount'] = $item['amount'];
                $invoiceItem['price'] = $item['price'];
                $invoiceItem['subtotal'] = $item['subtotal'];
                $invoiceItem['invoice_id'] = $id;
            }

            DB::table('invoice_items')->insert([
                [
                    'name' => $invoiceItem['name'],
                    'amount' => $invoiceItem['amount'],
                    'price' => $invoiceItem['price'],
                    'subtotal' => $invoiceItem['subtotal'],
                    'invoice_id' => $invoiceItem['invoice_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);

        });
    }
}
