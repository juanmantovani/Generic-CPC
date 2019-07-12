<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Validator;

class UserController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function index(){

       }
 
    public function perfil($id)
    {
         $usuario = User::findOrFail($id);
         //dd($usuario);
        return view('administracion.usuario.perfil', compact('usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function update2(Request $request, $id)
    {
        try {
        
       
         $usuario = User::findOrFail($id);
         $usuario->name=$request->name;
         $usuario->email=$request->email;
         //dd($request);
         if($request->password!=null){
            if(strlen($request->password)>6){
                $password = bcrypt($request->password);
                $usuario->password=$password;
            }else{
                return Redirect::to('/administracion')->with(['titulo'=>'Modificación de perfil','status'=> 'Error al modificar el perfil, minimo 6 digitos!','tipo'=>'danger']);

            }
         }
        $usuario->save();
        //update the auth, will needed for refresh UI
          return Redirect::to('/administracion')->with(['titulo'=>'Modificación de perfil','status'=> 'Se modifico  exitosamente el perfil!','tipo'=>'success']); 
            
        } catch (PDOException $e) {
             return Redirect::to('/administracion')->with(['titulo'=>'Modificación de perfil','status'=> 'Error al modificar el perfil!','tipo'=>'danger']);  
        }
    }



    public function create()
    {
         return view('administracion.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
