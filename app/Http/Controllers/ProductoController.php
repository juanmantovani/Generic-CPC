<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DataTables;


class ProductoController extends Controller
{
    public function index()
    {
        return view('administracion.almacen.productos.index');
    }
    
 
    public function todos_los_productos()
    {
        $productos=db::table('productos')->join('categorias','productos.categoria_id','categorias.id')->select('productos.id as id','productos.nombre as nombre','productos.codigo as codigo','categorias.nombre as cate_nombre','productos.precio as precio')->get();

        return Datatables::of($productos)->make();
    }

    public function create()
    {
        $categorias=DB::table('categorias')->get(); //Para mostrar en el alta de producto
        return view('administracion.almacen.productos.create',compact('categorias'));
    }

    public function store(Request $request)
    {
       // dd($request->fecha_ingreso,$request->fecha_vencimiento,$request->fecha_retiro_gondola);

        Carbon::setLocale('es');
        $format = "d/m/Y";

        $producto= new Producto;
        $producto->categoria_id=$request->idcategoria;
        $producto->codigo=$request->codigo;
        $producto->nombre=$request->nombre;
        $producto->precio=$request->precio;
        $producto->descripcion=$request->descripcion;
        $producto->save();
        
        return Redirect::to('/administracion/productos')->with(['titulo'=>'Nuevo Producto','status'=> 'Se añadio exitosamente un nuevo producto!','tipo'=>'success']);  
    }

    public function show($id)
    {    
        $producto=db::table('productos')->find($id);
        
        $categoria=DB::table('categorias')->find($producto->categoria_id);
        
        return view("administracion.almacen.productos.show",compact('producto','categoria'));
    }

    public function edit($id)
    {
        $producto=db::table('productos')->find($id);

        $categorias=DB::table('categorias')->get();

        return view("administracion.almacen.productos.edit",compact('producto','categorias'));
    }

    public function update(Request $request, $id)
    {
        try{
            $producto=Producto::findOrFail($id);
            $producto->categoria_id=$request->get('idcategoria');
            $producto->codigo=$request->get('codigo');
            $producto->nombre=$request->get('nombre');
            $producto->precio=$request->get('precio');
            $producto->descripcion=$request->get('descripcion');

            $producto->update();
 
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Actualización de Producto','status'=> 'Se actualizó exitosamente el producto!','tipo'=>'success']); 

        }catch(PDOException $e){
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Actualización de Producto','status'=> 'Error al actualizar el producto!','tipo'=>'danger']);
        }
    }

    public function destroy($id)
    {
        try{
            $producto=Producto::findOrFail($id);
            $producto->delete();
       
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Eliminación de Producto','status'=> 'Se elimino exitosamente el producto!','tipo'=>'success']);  
        }catch(PDOException $e){
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Eliminación de Producto','status'=> 'Error al eliminar el producto!','tipo'=>'danger']);  
        }
    }

    public function bajas(Request $response)
      {
        if($response->baja==null){
            return back()->withInput()->with(['titulo'=>'Eliminación de producto','status'=> 'Si desea eliminar el/los productos, debe seleccionar al menos 1. Acción no completada','tipo'=>'danger']);
        }else{
            $productos=db::table('productos')->wherein('id',$response->baja)->update(['estado'=>0]);
            return back()->withInput()->with(['titulo'=>'Eliminacion de productos','status'=> 'Eliminacion exitosa!','tipo'=>'success']);
        }

      }

      public function dataAjaxProducto (Request $request){
        $data = [];
        if($request->has('codigo')){
            $search = $request->q;
            $data = Producto::select("nombre","precio")
            ->where('codigo',$request->codigo)
            ->get();
        }
        if(count($data) <> 0){
            return response()->json($data);
        }else{
            return response()->json($data);

        }
    }
}
