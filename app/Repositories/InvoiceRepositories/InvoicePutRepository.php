<?php

namespace App\Repositories\InvoiceRepositories;

use App\Models\Invoice;
use App\Models\InvoiceItem;



class InvoicePutRepository
{
    private $code;

    public function __construct()
    {
        $this->code = http_response_code(404);
    }

    public function update($body, $id)
    {
        $invoice = Invoice::find($id);

        if ($invoice != null) {
            $invoice->update([
                'supplier' => $body->input('supplier'),
                'pay_term' => $body->input('pay_term'),
                'date' => $body->input('date'),
                'created' => $body->input('created'),
                'status' => $body->input('status'),
                'observations' => $body->input('observations')
            ]);

            $invoiceItem = [];

            foreach ($body->items as $item) {
                $id = InvoiceItem::find($item['id']);

                if (!empty($id)) {
                    //actualizar
                    $id->update([
                        'name' => $item['name'],
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal']
                    ]);
                } else {
                    //crear uno nuevo
                    $invoiceItem[] = new InvoiceItem($item);
                }

            }

            $invoice->invoiceItems()->saveMany($invoiceItem);

            $this->code = http_response_code(201);

            return http_response_code();
        }
        return http_response_code();
    }
}
