<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datosItem = Items::all();

        return response()->json($datosItem);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datosItems = new Items();

        $datosItems -> product_name= $request->product_name;
        $datosItems -> amount=$request->amount;
        $datosItems -> price=$request->price;
        $datosItems -> subtotal=$request->subtotal;

        $datosItems->save();

        return response()->json($request);

        /* $request->validate([

              'product_name' => 'required',
              'amount' => 'required',
              'price' => 'required',
              'subtotal' => 'required',

          ]);

          $datosItem = Items::create($request->all());

          return response($datosItem);*/

      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function show($id)
    {
        $datosItem = Items::findOrFail($id);
        return response($datosItem);
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
        $datosItem = Items::findOrFail($id)->update($request->all());
        return response($datosItem);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Items::destroy($id);
        return \response("El ${id} ha sido eliminado de la orden");
    }
}
