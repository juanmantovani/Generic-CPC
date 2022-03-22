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
 
    public function index(){

    }
 
    public function perfil($id)
    {
        $usuario = User::findOrFail($id);
        return view('administracion.usuario.perfil', compact('usuario'));
    }

   
    public function update2(Request $request, $id)
    {
        try {
           $usuario = User::findOrFail($id);
            $usuario->name=$request->name;
            $usuario->email=$request->email;

            if($request->password!=null){
                if(strlen($request->password)>6){
                $password = bcrypt($request->password);
                $usuario->password=$password;
                }else{
                    return Redirect::to('/administracion')->with(['titulo'=>'Modificación de perfil','status'=> 'Error al modificar el perfil, minimo 6 digitos!','tipo'=>'danger']);
                }
            }
            $usuario->save();
            return Redirect::to('/administracion')->with(['titulo'=>'Modificación de perfil','status'=> 'Se modifico  exitosamente el perfil!','tipo'=>'success']); 
        } catch (PDOException $e) {
            return Redirect::to('/administracion')->with(['titulo'=>'Modificación de perfil','status'=> 'Error al modificar el perfil!','tipo'=>'danger']);  
        }
    }

    public function create()
    {
         return view('administracion.users.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
