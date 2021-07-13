<?php

namespace App\Http\Controllers\InvoiceControllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class InvoicePutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $invoice = Invoice::find($id);

            $invoice->update([
                'supplier' => $request->input('supplier'),
                'pay_term' => $request->input('pay_term'),
                'date' => $request->input('date'),
                'created' => $request->input('created'),
                'status' => $request->input('status'),
                'observations' => $request->input('observations')
            ]);

            $invoiceItem = [];

            foreach ($request->items as $item) {
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

            return http_response_code(201);

        });
    }
}
