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
            $productos=db::table('productos')->where('fecha_vencimiento','<',$fecha_vencimiento)->where('estado',1)->get();
        //    dd($productos);
        }
        else
        {
           // dd($request->cat);
             $productos=db::table('productos')->where('categoria_id',$request->cat)->where('fecha_vencimiento','<',$fecha_vencimiento)->where('estado',1)->get();
        }
        $data["productos"]=$productos;
        return $data;
    }


     public function chart()
      {// productos que vencen 5 dias despues del actual dia
         Carbon::setlocale('es');
        $hoy=Carbon::now();
        $dias=array();
        $i=0;
        $dias[0]=$hoy->format("Y-m-d");
        
        $i=$i+1;
        while ($i <= 4) {
            $var_dia=$hoy->addDay();
            $dias[$i]=$var_dia->format("Y-m-d");
            $i++;
        }

        $res=db::table('productos')->where('estado',1)->wherein('fecha_vencimiento',$dias)->get();

        return response()->json($res);
      }

       


}
