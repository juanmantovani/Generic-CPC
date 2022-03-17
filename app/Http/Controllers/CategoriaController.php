<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use \Toastr;
use App\Categoria;
use DataTables;

use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('administracion.almacen.categorias.index');
    }

    public function todas_las_categorias(){
         $categorias=db::table('categorias')->select('categorias.id as id','categorias.nombre as nombre','categorias.descripcion as descripcion','categorias.condicion as condicion')->orderby('categorias.condicion','asc')->get();
        return Datatables::of($categorias)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.almacen.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $categoria = new Categoria;
            $categoria->create($request->all());
              return Redirect::to('/administracion/categorias')->with(['titulo'=>'Creación de una Categoría','status'=> 'Se creó exitosamente la categoría','tipo'=>'success']);
        }
        catch(PDOException $e){
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Creación de una categoría','status'=> 'Error al crear la categoría!','tipo'=>'danger']);  
              }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view("administracion.almacen.categorias.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return view("administracion.almacen.categorias.edit",["categoria"=>Categoria::findOrFail($id)]);
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
        try {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        if($request->condicion==0){
            $productos=db::table("productos")->where('categoria_id',$id)->update(['estado'=>0]);
        }else{
             $productos=db::table("productos")->where('categoria_id',$id)->update(['estado'=>1]);
        }
        $categoria->condicion=$request->condicion;
        $categoria->update();
       
         return Redirect::to('/administracion/categorias')->with(['titulo'=>'Actualización de una Categoría','status'=> 'Se actualizó exitosamente la categoría','tipo'=>'success']);  
            
        } catch (PDOException $e) {
              return Redirect::to('/administracion/productos')->with(['titulo'=>'Actualización de una categoría','status'=> 'Error al actualizar la categoría!','tipo'=>'danger']);  
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
        try{
            $cat = Categoria::findOrFail($id);
            $cat->delete();
        }catch(PDOException $e){
             return Redirect::to('/administracion/productos')->with(['titulo'=>'Eliminación de una categoría','status'=> 'Error al eliminar la categoría!','tipo'=>'danger']);   
        }
          return Redirect::to('/administracion/categorias')->with(['titulo'=>'Eliminación de una Categoría','status'=> 'Se elimino exitosamente la categoría con el/los productos asociados!','tipo'=>'success']);  
    }

    public function store_ajax_modal(Request $request){
        $categoria = new Categoria;
        if($request->nombre==""){
            Session::put('tipo','danger');
            Session::put('titulo','Creacion de categoría');
             Session::put('status','Categoria no creada!');
         /*   $var['tipo']="danger";
            $var['titulo']="Creacion de categoria";
            $var['status']="Categoria no creada";*/
            $var="No-Ok";
            
            return response()->json($var);
            //return back()->withInput()->with(['titulo'=>'Creacion de categoria','status'=> 'Categoria creada con exito!','tipo'=>'success']);
        
        }else{
            $categoria = new Categoria;
            $categoria->create($request->all());
            Session::put('tipo','success');
            Session::put('titulo','Creación de categoría');
             Session::put('status','Categoría creada con exito!');
         $var="Ok";
            return response()->json($var);
        }
 

    }
}
