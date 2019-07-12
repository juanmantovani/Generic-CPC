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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Paso a datatable
        $productos=db::table('productos')->join('categorias','productos.categoria_id','categorias.id')->select('productos.*','categorias.nombre as cate_nombre')->orderby('productos.fecha_retiro_gondola')->get();
           $format = "d/m/Y";

           foreach ($productos as $unproducto) {
            $unproducto->fecha_retiro_gondola=\Carbon\Carbon::parse($unproducto->fecha_retiro_gondola)->format('d/m/Y');
           }*/
           return view('administracion.almacen.productos.index');
    }
    
 
    public function todos_los_productos()
    {

        $productos=db::table('productos')->join('categorias','productos.categoria_id','categorias.id')->select('productos.id as id','productos.nombre as nombre','productos.codigo as codigo','categorias.nombre as cate_nombre','productos.stock as stock','productos.dias_ant_retiro as dias','productos.fecha_retiro_gondola as fecha_retiro_gondola', 'productos.fecha_ingreso as fecha_ingreso','productos.fecha_vencimiento as fecha_vencimiento','productos.estado as estado')->orderby('productos.estado','desc')->orderby('productos.fecha_retiro_gondola','asc')->get();
/*
        foreach ($productos as $unproducto) {
            $unproducto->fecha_retiro_gondola=\Carbon\Carbon::parse($unproducto->fecha_retiro_gondola)->format('d/m/Y');
            $unproducto->fecha_ingreso=\Carbon\Carbon::parse($unproducto->fecha_ingreso)->format('d/m/Y');
            $unproducto->fecha_vencimiento=\Carbon\Carbon::parse($unproducto->fecha_vencimiento)->format('d/m/Y');
        }*/
        return Datatables::of($productos)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=DB::table('categorias')->where('condicion','=','1')->get(); //Para mostrar en el alta de producto
        return view('administracion.almacen.productos.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->fecha_ingreso,$request->fecha_vencimiento,$request->fecha_retiro_gondola);

        Carbon::setLocale('es');
        $format = "d/m/Y";

        $producto= new Producto;
        $producto->categoria_id=$request->idcategoria;
        $producto->codigo=$request->codigo;
        $producto->nombre=$request->nombre;
        $producto->stock=$request->stock;
        $producto->descripcion=$request->descripcion;
        //Formateo de fecha
         $fecha_ingreso=$request->fecha_ingreso;
        $fecha_vencimiento=$request->fecha_vencimiento;
        $fecha_retiro_gondola=$request->fecha_retiro_gondola;
        
        $producto->fecha_ingreso= Carbon::createFromFormat($format, $fecha_ingreso);
        $producto->fecha_vencimiento= Carbon::createFromFormat($format, $fecha_vencimiento);
        $producto->fecha_retiro_gondola= Carbon::createFromFormat($format, $fecha_retiro_gondola);
       
       $producto->dias_ant_retiro=$request->dias_ant_retiro;
        

        $producto->estado=1;
        if (Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
                $producto->imagen=$file->getClientOriginalName();
        }    
      //  dd($producto);
        $producto->save();
        return Redirect::to('/administracion/productos')->with(['titulo'=>'Nuevo Producto','status'=> 'Se añadio exitosamente un nuevo producto!','tipo'=>'success']);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    $producto=db::table('productos')->find($id);
      
         $categoria=DB::table('categorias')->where('condicion','=','1')->find($producto->categoria_id);
  // dd($producto,$categoria);
        return view("administracion.almacen.productos.show",compact('producto','categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto=db::table('productos')->find($id);
     //  dd($producto);
        $categorias=DB::table('categorias')->where('condicion','=','1')->get();
        return view("administracion.almacen.productos.edit",compact('producto','categorias'));
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
        try{
             $producto=Producto::findOrFail($id);
            $producto->categoria_id=$request->get('idcategoria');
            $producto->codigo=$request->get('codigo');
            $producto->nombre=$request->get('nombre');
            $producto->stock=$request->get('stock');
            $producto->descripcion=$request->get('descripcion');
            $producto->dias_ant_retiro=$request->dias_ant_retiro;
            $producto->estado=$request->get('estado');

             Carbon::setLocale('es');
            $format = "d/m/Y";
            $fecha_ingreso=$request->fecha_ingreso;
            $fecha_vencimiento=$request->fecha_vencimiento;
            $fecha_retiro_gondola=$request->fecha_retiro_gondola;
            $producto->fecha_ingreso= Carbon::createFromFormat($format, $fecha_ingreso);
            $producto->fecha_vencimiento= Carbon::createFromFormat($format, $fecha_vencimiento);
            $producto->fecha_retiro_gondola= Carbon::createFromFormat($format, $fecha_retiro_gondola);
           
            

            if (Input::hasFile('imagen')){
                    $file=Input::file('imagen');
                    $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
                    $producto->imagen=$file->getClientOriginalName();
            }    
            $producto->update();
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Actualización de Producto','status'=> 'Se actualizó exitosamente el producto!','tipo'=>'success']); 

        }catch(PDOException $e){
             return Redirect::to('/administracion/productos')->with(['titulo'=>'Actualización de Producto','status'=> 'Error al actualizar el producto!','tipo'=>'danger']);  

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //     $producto=db::table('productos')->where('id',$id)->update(['estado'=>0]);
        try{
        $producto=Producto::findOrFail($id);
        $producto->delete();
        return Redirect::to('/administracion/productos')->with(['titulo'=>'Eliminación de Producto','status'=> 'Se elimino exitosamente el producto!','tipo'=>'success']);  
        }catch(PDOException $e){
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Eliminación de Producto','status'=> 'Error al eliminar el producto!','tipo'=>'danger']);  
        }
       // $producto->estado=0;
        //return Redirect::to('/administracion/almacen/productos ');
    }


        public function bajas(Request $response)
      {
        if($response->baja==null){
              return back()->withInput()->with(['titulo'=>'Eliminación de producto','status'=> 'Si desea eliminar el/los productos, debe seleccionar al menos 1. Acción no completada','tipo'=>'danger']);
        }else{

            $productos=db::table('productos')->wherein('id',$response->baja)->update(['estado'=>0]);

             return back()->withInput()->with(['titulo'=>'Eliminacion de productos','status'=> 'Eliminacion exitosa!','tipo'=>'success']);

       // dd($productos);


        }

      }
}
