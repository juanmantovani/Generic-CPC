<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Producto;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DataTables;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion.clientes.index');
    }

    public function todos_los_clientes()
    {
        $clientes=db::table('personas')->join('ciudades','personas.ciudad_id','ciudades.id')
        ->where('personas.tipo','1')
        ->select('personas.id as id','personas.nombre as nombre','personas.razon_social as razon_social','personas.cuil as cuil','personas.direccion as direccion','ciudades.nombre as ciudad')->get();

        return Datatables::of($clientes)->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades=DB::table('ciudades')->get(); //Para mostrar en el alta de clientes
        return view('administracion.clientes.create',compact('ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente= new Persona;
        $cliente->nombre=$request->nombre;
        $cliente->razon_social=$request->razon_social;
        $cliente->dni=$request->dni;
        $cliente->cuil=$request->cuil;
        $cliente->direccion=$request->direccion;
        $cliente->tipo = 1;
        $cliente->ciudad_id=$request->idciudad;

        $cliente->save();
        return Redirect::to('/administracion/clientes')->with(['titulo'=>'Nuevo Cliente','status'=> 'Se añadió exitosamente un nuevo cliente!','tipo'=>'success']);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente=db::table('personas')->find($id);
      
        $ciudad=DB::table('ciudades')->find($cliente->ciudad_id);

        return view("administracion.clientes.show",compact('cliente','ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente=db::table('personas')->find($id);

        $ciudades=DB::table('ciudades')->get();
        return view("administracion.clientes.edit",compact('cliente','ciudades'));
    
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
            $cliente=Persona::findOrFail($id);
            $cliente->nombre=$request->get('nombre');
            $cliente->razon_social=$request->get('razon_social');
            $cliente->dni=$request->get('dni');
            $cliente->cuil=$request->get('cuil');
            $cliente->direccion=$request->direccion;
            $cliente->ciudad_id=$request->get('idciudad');
         
            $cliente->update();
            return Redirect::to('/administracion/clientes')->with(['titulo'=>'Actualización de cliente','status'=> 'Se actualizó exitosamente el cliente!','tipo'=>'success']); 
        }catch(PDOException $e){
            return Redirect::to('/administracion/clientes')->with(['titulo'=>'Actualización de cliente','status'=> 'Error al actualizar el cliente!','tipo'=>'danger']);  
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
            $cliente=Persona::findOrFail($id);
            $cliente->delete();
            return Redirect::to('/administracion/clientes')->with(['titulo'=>'Eliminación de Cliente','status'=> 'Se elimino exitosamente el cliente!','tipo'=>'success']);  
        }catch(PDOException $e){
            return Redirect::to('/administracion/productos')->with(['titulo'=>'Eliminación de Cliente','status'=> 'Error al eliminar el cliente!','tipo'=>'danger']);  
        }
    }
}
