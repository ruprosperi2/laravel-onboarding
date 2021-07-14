<?php

namespace App\Http\Controllers\InvoiceControllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Invoice;

class InvoiceGetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $invoice = Invoice::find($id);

        $invoice->invoiceItems;

        return response()->json($invoice);
    }
}
