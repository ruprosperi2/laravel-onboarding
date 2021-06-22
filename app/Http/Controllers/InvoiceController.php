<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

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
        $invoice = new Invoice;

        $invoice->supplier = $request->supplier;
        $invoice->pay_term = $request->pay_term;
        $invoice->date = $request->date;
        $invoice->created = $request->created;
        $invoice->status = $request->status;
        $invoice->observations = $request->observations;

        $invoice->save();

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
        $invoice = Invoice::find($id);

        $invoice->supplier = $request->supplier;
        $invoice->pay_term = $request->pay_term;
        $invoice->date = $request->date;
        $invoice->created = $request->created;
        $invoice->status = $request->status;
        $invoice->observations = $request->observations;

        $invoice->save();

        return response()->json($invoice);

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

        $invoice->delete();
    }
}
