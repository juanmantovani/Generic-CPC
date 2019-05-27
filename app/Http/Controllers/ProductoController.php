<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //$productos=Producto::all();
        $productos=db::table('productos')->join('categorias','productos.categoria_id','categorias.id')->select('productos.*','categorias.nombre as cate_nombre')->paginate(5);
       // dd($productos);
      
        return view('administracion.almacen.productos.index',compact('productos'));
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
   //     dd($request);

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
        $producto->fecha_ingreso= Carbon::createFromFormat($format, $fecha_ingreso);
        $producto->fecha_vencimiento= Carbon::createFromFormat($format, $fecha_vencimiento);
       
        $producto->estado=1;
        if (Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
                $producto->imagen=$file->getClientOriginalName();
        }    
      //  dd($producto);
        $producto->save();
        return Redirect::to('/administracion');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("administracion.almacen.productos.show",["producto"=>Producto::findOrFail($id)]);
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
         $producto=Producto::findOrFail($id);
        $producto->categoria_id=$request->get('idcategoria');
        $producto->codigo=$request->get('codigo');
        $producto->nombre=$request->get('nombre');
        $producto->stock=$request->get('stock');
        $producto->descripcion=$request->get('descripcion');
        $producto->estado=1;
        if (Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
                $producto->imagen=$file->getClientOriginalName();
        }    
        $producto->update();
        return Redirect::to('/administracion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->estado=0;
        $producto->update();
        return Redirect::to('/administracion/almacen/productos ');
    }
}
