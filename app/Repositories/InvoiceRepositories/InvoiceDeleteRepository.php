<?php

namespace App\Repositories\InvoiceRepositories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use function PHPUnit\Framework\isNull;


class InvoiceDeleteRepository
{
    private $code;

    public function __construct()
    {
        $this->code = http_response_code(404);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if ( $invoice != null ) {

            $this->code = http_response_code(204);

            InvoiceItem::where('invoice_id', $invoice->id)->delete();

            $invoice->delete();

            return http_response_code();
        }

        return http_response_code();

    }
}
