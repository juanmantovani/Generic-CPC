<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Pedido;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DataTables;

class PedidoController extends Controller
{
   
    public function index()
    {
        return view('administracion.pedidos.index');
    }

    public function todos_los_pedidos()
    {
        $pedidos=db::table('pedidos')
        ->join('personas','pedidos.cliente_id','personas.id')
        ->select('pedidos.id as id','personas.nombre as cliente','pedidos.created_at as fecha','pedidos.observacion as observacion','pedidos.total as total')->get();

        return Datatables::of($pedidos)->make();
    }
 
    public function create()
    {
        return view('administracion.pedidos.create');
    }

  
    public function store(Request $request)
    {
        dd($request);
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
