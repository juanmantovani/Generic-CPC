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
    public function index()
    {
        return view('administracion.almacen.categorias.index');
    }

    public function todas_las_categorias(){
        $categorias=db::table('categorias')->select('categorias.id as id','categorias.nombre as nombre','categorias.descripcion as descripcion')->get();
        return Datatables::of($categorias)->make();
    }

    public function create()
    {
        return view('administracion.almacen.categorias.create');
    }

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

    public function show($id)
    {
         return view("administracion.almacen.categorias.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
         return view("administracion.almacen.categorias.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        try {
            $categoria=Categoria::findOrFail($id);
            $categoria->nombre=$request->nombre;
            $categoria->descripcion=$request->descripcion;

            $categoria->update();
       
            return Redirect::to('/administracion/categorias')->with(['titulo'=>'Actualización de una Categoría','status'=> 'Se actualizó exitosamente la categoría','tipo'=>'success']);  
            
        }catch (PDOException $e) {
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Actualización de una categoría','status'=> 'Error al actualizar la categoría!','tipo'=>'danger']);  
        }
    }

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
            $var="No-Ok";
            
            return response()->json($var);
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
