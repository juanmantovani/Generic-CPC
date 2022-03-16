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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
