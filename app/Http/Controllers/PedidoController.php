<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use App\Pedido;
use App\Producto;
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
        ->join('ciudades','personas.ciudad_id','ciudades.id')
        ->select('pedidos.id as id','personas.nombre as cliente','pedidos.created_at as fecha','ciudades.nombre as ciudad','pedidos.total as total')
        ->orderBy('pedidos.created_at', 'DESC')->get();

        return Datatables::of($pedidos)->make();
    }
 
    public function create()
    {
        return view('administracion.pedidos.create');
    }

  
    public function store(Request $request)
    {
        $pedido= new Pedido;
        $pedido->cliente_id=$request->idCliente;
        $pedido->total = $request->total;
        $pedido->save();

        $ultimoPedido =  DB::table('pedidos')->max('id');
        
        for($i=0;$i<count($request->filas);$i++){
            $aux = Producto::select("id")
            ->where('codigo',$request->filas[$i]['codigo'])
            ->get();

            $producto_id = $aux[0]->id;
            $cantidad = $request->filas[$i]['cantidad'];

            DB::insert("insert into productos_pedido (producto_id,pedido_id,cantidad) values ($producto_id, $ultimoPedido, $cantidad )");
        }

        Session::put('tipo', 'success');
            Session::put('titulo', 'Confirmación de pedido');
            Session::put('status', 'Pedido confirmado con exito!');
            $var="Ok";
            return response()->json($var);  
    }

    public function show($id)
    {
        $pedido=db::table('pedidos')
        ->join('personas','pedidos.cliente_id','personas.id')
        ->join('ciudades', 'personas.ciudad_id','ciudades.id')
        ->where('pedidos.id',$id)
        ->select('pedidos.id as id','personas.nombre as nombre','personas.razon_social as razon_social','pedidos.created_at as fecha','personas.direccion as direccion','pedidos.total as total','ciudades.nombre as ciudad','personas.cuil as cuil')->get();
    
        $productos=db::table('pedidos')
        ->join('productos_pedido','pedidos.id','productos_pedido.pedido_id')
        ->join('productos','productos.id','productos_pedido.producto_id')
        ->where('pedidos.id',$id)
        ->select('productos.codigo as codigo','productos.nombre as producto','productos_pedido.cantidad as cantidad', 'productos.precio as precio')->get();;

        return view('administracion.pedidos.show',compact('pedido','productos'));
    }

    public function pedidoShow (){
        
        
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
