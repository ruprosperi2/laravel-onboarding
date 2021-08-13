<?php

namespace Src\PurchaseInvoice\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;
use Src\PurchaseInvoice\Domain\PurchaseInvoice;
use Src\PurchaseInvoice\Domain\ValueObjects\Supplier;
use Src\PurchaseInvoice\Domain\ValueObjects\Payterm;
use Src\PurchaseInvoice\Domain\ValueObjects\DateCreation;
use Src\PurchaseInvoice\Domain\ValueObjects\Created;
use Src\PurchaseInvoice\Domain\ValueObjects\Status;
use Src\PurchaseInvoice\Domain\ValueObjects\Observations;
use Src\PurchaseInvoice\Domain\ValueObjects\Items;

class PurchaseInvoiceMysqlRepository implements PurchaseInvoiceRepository
{
    public function findAll(): object
    {
        return $result = DB::table('invoices')->get();
    }

    public function find(Id $id): PurchaseInvoice
    {
        $data = DB::table('invoices')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->select('invoices.*', 'invoice_items.*')
            ->where('invoices.id', '=', $id->value())
            ->get();

       $arreglo = json_decode($data, TRUE);

        $purchaseInvoiceItems = [];

        for($i=0; $i<count($arreglo); $i++){
            $purchaseInvoiceItems[$i]['name'] = $arreglo[$i]['name'];
            $purchaseInvoiceItems[$i]['amount'] = $arreglo[$i]['amount'];
            $purchaseInvoiceItems[$i]['price'] = $arreglo[$i]['price'];
            $purchaseInvoiceItems[$i]['subtotal'] = $arreglo[$i]['subtotal'];
            $purchaseInvoiceItems[$i]['invoice_id'] = $arreglo[$i]['invoice_id'];
        }

        $items = new Items($purchaseInvoiceItems);

        $invoice = [];

        foreach ($arreglo as $item){
            $invoice['supplier'] =  new Supplier($item['supplier']);
            $invoice['pay_term'] = new Payterm($item['pay_term']);
            $invoice['date'] = new DateCreation($item['date']);
            $invoice['created'] = new Created($item['created']);
            $invoice['status'] = new Status($item['status']);
            $invoice['observations'] = new Observations($item['observations']);
            $invoice['items'] = $items;
        }



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

            $i = 0;

            foreach ($body->items()->value() as $item) {
                $invoiceItem[$i]['name'] = $item['name']->value();
                $invoiceItem[$i]['amount'] = $item['amount']->value();
                $invoiceItem[$i]['price'] = $item['price']->value();
                $invoiceItem[$i]['subtotal'] = $invoiceItem[$i]['amount'] * $invoiceItem[$i]['price'];
                $invoiceItem[$i]['invoice_id'] = $id;

                DB::table('invoice_items')->insert([
                    [
                        'name' => $invoiceItem[$i]['name'],
                        'amount' => $invoiceItem[$i]['amount'],
                        'price' => $invoiceItem[$i]['price'],
                        'subtotal' => $invoiceItem[$i]['subtotal'],
                        'invoice_id' => $invoiceItem[$i]['invoice_id'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);
                $i++;
            }

        });
    }

    public function delete(Id $id): void
    {
        DB::transaction(function () use ($id) {
            DB::table('invoices')->where('id', '=', $id->value())->delete();
        });
    }
}
