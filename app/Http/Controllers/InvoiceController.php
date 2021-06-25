<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Invoice::all() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create( $request->all() );

        $invoiceItems = [];

        foreach ($request->items as $item){
            $invoiceItems[] = new InvoiceItem($item);
        }

        $invoice->invoiceItems()->saveMany($invoiceItems);

        return  response()->json($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);

        $invoice->invoiceItems;

        return response()->json($invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        DB::transaction( function () use ($request, $id){

            $invoice = Invoice::find($id);

            $invoice->update([
                'supplier' => $request->input('supplier'),
                'pay_term' => $request->input('pay_term'),
                'date' => $request->input('date'),
                'created' => $request->input('created'),
                'status' => $request->input('status'),
                'observations' => $request->input('observations')
            ]);

            $invoiceItem =  [];

            foreach ($request->items as $item){
                $id = InvoiceItem::find($item['id']);

                if( !empty($id) ){
                    //actualizar
                    $id->update([
                        'name' => $item['name'],
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal']
                    ]);
                }else{
                    //crear uno nuevo
                    $invoiceItem[]= new InvoiceItem($item);
                }

//                exit;
//
//                $invoiceItem->update([
//                    'name' => $item['name'],
//                    'amount' => $item['amount'],
//                    'price' => $item['price'],
//                    'subtotal' => $item['subtotal']
//                ]);
            }

            $invoice->invoiceItems()->saveMany($invoiceItem);

//            if($request->items[0]['id'] == $data[0]['id']){
//                InvoiceItem->update([
//                    'name' => $request->input('name'),
//                    'amount' => $request->input('amount'),
//                    'price' => $request->input('price'),
//                    'subtotal' => $request->input('subtotal'),
//                ]);
//            }

            return response()->json($invoice);

        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        $invoiceItem = InvoiceItem::where('invoice_id', $invoice->id)->delete();

        $invoice->delete();

        return response()->json('borrado');
    }
}
