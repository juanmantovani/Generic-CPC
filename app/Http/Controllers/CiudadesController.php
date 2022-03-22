<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use \Toastr;
use App\Ciudad;
use DataTables;

class CiudadesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
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

    public function store_ajax_modal_ciudad(Request $request){
        $ciudad = new Ciudad;
        if ($request->nombre=="") {
            Session::put('tipo', 'danger');
            Session::put('titulo', 'Creacion de ciudad');
            Session::put('status', 'Ciudad no creada!');
            $var="No-Ok";
            
            return response()->json($var);
        } else {
            $ciudad = Ciudad::create([
                'nombre' => $request->nombre
            ]);
            Session::put('tipo', 'success');
            Session::put('titulo', 'Creación de ciudad');
            Session::put('status', 'Ciudad creada con exito!');
            $var="Ok";
            return response()->json($var);
        }
    }
}
