<?php

namespace App\Repositories\InvoiceRepositories;

use App\Models\Invoice;
use App\Models\InvoiceItem;


class InvoicePostRepository
{
    public function store($body)
    {
        $invoice = Invoice::create($body->all());

        $invoiceItems = [];

        foreach ($body->items as $item) {
            $invoiceItems[] = new InvoiceItem($item);
        }

        $invoice->invoiceItems()->saveMany($invoiceItems);

        return http_response_code();
    }
}
