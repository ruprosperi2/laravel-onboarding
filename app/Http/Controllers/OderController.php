<?php

namespace App\Http\Controllers;

use App\Models\Oders;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosOders = Oders::all();

        return response()->json($datosOders);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = Carbon::now();

        $datosOders = new Oders();

        $datosOders -> date= $date;
        $datosOders -> created_by=$request->created_by;
        $datosOders -> supplier=$request->supplier;
        $datosOders -> payment_term=$request->payment_term;
        $datosOders -> status=$request->status;
        $datosOders -> observations=$request->observations;

        $datosOders->save();

        return response()->json($request);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datosOders = Oders::findOrFail($id);

        $datosOders->items;

        return response($datosOders);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $datosOders = Oders::findOrFail($id)->update($request->all());
        return response($datosOders);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Oders::destroy($id);
        return \response("El ${id} ha sido eliminado exitosamente");
    }
}
