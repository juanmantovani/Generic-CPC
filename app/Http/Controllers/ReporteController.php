<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Categoria;
use Carbon\Carbon;


class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categorias=db::table('categorias')->where('condicion',1)->get();
        return view('administracion.reporte.index',compact('categorias'));
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
    public function get_vencidos(Request $request){

      //  Carbon::setLocale('es');
        $format = "d/m/Y";
        $fecha_vencimiento=Carbon::createFromFormat($format,$request->fecha_v);
         //$fecha_vencimiento=Carbon::parse($request->fecha_v)->format('d/m/Y');
       
        // $fecha_vencimiento=
         //   dd($fecha_vencimiento);


        if($request->cat==null){
            $productos=db::table('productos')->where('fecha_vencimiento','<',$fecha_vencimiento)->get();
        //    dd($productos);
        }
        else
        {
           // dd($request->cat);
             $productos=db::table('productos')->where('categoria_id',$request->cat)->where('fecha_vencimiento','<',$fecha_vencimiento)->get();
        }
        $data["productos"]=$productos;
        return $data;
    }
}
