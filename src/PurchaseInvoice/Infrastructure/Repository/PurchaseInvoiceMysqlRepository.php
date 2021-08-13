<?php

namespace Src\PurchaseInvoice\Infrastructure\Repository;

use Illuminate\Support\Arr;
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

    public function find(Id $id): object
    {
        $data = DB::table('invoices')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->select('invoices.*', 'invoice_items.*')
            ->where('invoices.id', '=', $id->value())
            ->get();

        return $data;
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

            $this->saveItems($id, $body->items()->value());

        });
    }

    private function saveItems(int $id, array $items): void
    {
        $invoiceItem = [];

        $i = 0;

        foreach ($items as $item) {
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
    }

    public function delete(Id $id): void
    {
        DB::transaction(function () use ($id) {
            DB::table('invoices')->where('id', '=', $id->value())->delete();
        });
    }

    public function update(Id $id, PurchaseInvoice $body): void
    {
        DB::transaction(function () use ($id, $body) {
            $purchaseInvoiceUpdate = DB::table('invoices')
                ->where('id', $id->value())
                ->update([
                    'supplier' => $body->supplier()->value(),
                    'pay_term' => $body->payTerm()->value(),
                    'date' => $body->date()->value(),
                    'created' => $body->created()->value(),
                    'status' => $body->status()->value(),
                    'observations' => $body->observations()->value(),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            $getIdItemsDb = json_decode(DB::table('invoice_items')->pluck('id'), true); //Obtiene los Id de la base de datos

            $idItems = Arr::pluck($body->items()->value(), 'id'); // filtra un arreglo con la columna seleccionada

            $arrayItem = [];

            for ($i = 0; $i < count($idItems); $i++) {
                $arrayItem[$i] = $idItems[$i]->value();
            }

            $notIn = array_values(array_diff($getIdItemsDb, $arrayItem)); //comprueba los datos de $getIdItemsDb con respecto a $arrayItem

            if (!empty($notIn)) {

                foreach ($notIn as $id) {
                    DB::transaction(function () use ($id) {
                        DB::table('invoice_items')->where('id', '=', $id)->delete();
                    });
                }
            }

            $invoiceItem = [];
            $i = 0;

            foreach ($body->items()->value() as $item) {
                $invoiceItem[$i]['id'] = $item['id']->value();
                $invoiceItem[$i]['name'] = $item['name']->value();
                $invoiceItem[$i]['amount'] = $item['amount']->value();
                $invoiceItem[$i]['price'] = $item['price']->value();
                $invoiceItem[$i]['subtotal'] = $invoiceItem[$i]['amount'] * $invoiceItem[$i]['price'];
                $invoiceItem[$i]['invoice_id'] = $id;

                DB::table('invoice_items')
                    ->where('id', $invoiceItem[$i]['id'])
                    ->update(
                        [
                            'name' => $invoiceItem[$i]['name'],
                            'amount' => $invoiceItem[$i]['amount'],
                            'price' => $invoiceItem[$i]['price'],
                            'subtotal' => $invoiceItem[$i]['subtotal'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    );
                $i++;
            }
        });
    }
}
