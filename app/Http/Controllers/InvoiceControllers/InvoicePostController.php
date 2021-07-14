<?php

namespace App\Http\Controllers\InvoiceControllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoicePostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $invoice = Invoice::create($request->all());

        $invoiceItems = [];

        foreach ($request->items as $item) {
            $invoiceItems[] = new InvoiceItem($item);
        }

        $invoice->invoiceItems()->saveMany($invoiceItems);

        return response()->json($invoice);
    }
}
