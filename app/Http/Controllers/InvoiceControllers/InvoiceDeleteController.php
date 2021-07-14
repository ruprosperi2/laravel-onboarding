<?php

namespace App\Http\Controllers\InvoiceControllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $invoice = Invoice::find($id);

        InvoiceItem::where('invoice_id', $invoice->id)->delete();

        $invoice->delete();

        return http_response_code(200);
    }
}
