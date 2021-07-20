<?php

namespace App\Repositories\InvoiceRepositories;

use App\Models\Invoice;
use App\Models\InvoiceItem;


class InvoiceGetRepository
{
    private $code;

    public function __construct()
    {
        $this->code = http_response_code(404);
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice != null) {

            $invoice->invoiceItems;

            dd($invoice->toJson());

            return response()->json($invoice);
        }
        return http_response_code();
    }
}
