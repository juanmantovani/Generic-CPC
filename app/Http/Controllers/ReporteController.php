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
        $fetcha_retiro=Carbon::createFromFormat($format,$request->fecha_r);
         //$fecha_vencimiento=Carbon::parse($request->fecha_v)->format('d/m/Y');
       
        // $fecha_vencimiento=
         //   dd($fecha_vencimiento);


        if($request->cat==null){
            $productos=db::table('productos')->where('fecha_retiro_gondola','<',$fetcha_retiro)->where('estado',1)
            ->join('categorias','productos.categoria_id','categorias.id')
            ->select('productos.*','categorias.nombre as nombre_categoria')
            ->get();
        //    dd($productos);
        }
        else
        {
           // dd($request->cat);
             $productos=db::table('productos')->where('categoria_id',$request->cat)->where('fecha_retiro_gondola','<',$fetcha_retiro)->where('estado',1)
             ->join('categorias','productos.categoria_id','categorias.id')
             ->select('productos.*','categorias.nombre as nombre_categoria')
            ->get();
        }
     
        $data["productos"]=$productos;
        return $data;
    }


     public function chart()
      {// productos que vencen 5 dias despues del actual dia
         Carbon::setlocale('es');
        $hoy=Carbon::now();
        $dias=array();
        $var2=array();
        $i=0;
        $dias[0]=$hoy->format("Y-m-d");
        
        $i=$i+1;
        while ($i <= 4) {
            $var_dia=$hoy->addDay();
            $dias[$i]=$var_dia->format("Y-m-d");
            $i++;
        }

        $res=db::table('productos')->where('estado',1)->orderby('fecha_retiro_gondola')->wherein('fecha_retiro_gondola',$dias)->get();
        //$count=$res->groupby('fecha_vencimiento');
        $var=$res->groupby('fecha_retiro_gondola');
        $contador=$var->count();
        $i=0;
        foreach ($var as $clave => $value) 
        {
            $var2[$i]['fecha_retiro_gondola']=[$clave]; // Tengo la primer fecha
            if(is_object($value))
            {
                $var2[$i]['stock']=0;
                $j=0;
                foreach ($value as $clave2 => $value2) 
                {
                    $var2[$i]['fecha_retiro_gondola']=$value2->fecha_retiro_gondola;       
                    $var2[$i]['stock']=$value2->stock+$var2[$i]['stock'];
                    $var2[$i]["cantidad"]=$j;
                    $j++;
                }
            }
            $i++;
        }


    //dd($var2);
        return response()->json($var2);
      }

     public function detalle_proximos_vto(){
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

        $res=db::table('productos')->where('estado',1)->orderby('fecha_retiro_gondola')->wherein('fecha_retiro_gondola',$dias)->select('productos.nombre','productos.fecha_retiro_gondola as fecha_retiro_gondola','productos.stock as stock')->get();
        //$count=$res->groupby('fecha_vencimiento');
        $var=$res->groupby('fecha_retiro_gondola');
        $contador=$var->count();
        $var2 = array();
        
        $i=0;

        foreach ($var as $key => $value) {
            $var2[$i]=$value;
            $i++;
        }
        $var3["productos"]=$var2;

      
        return response()->json($var3);
      }

       


}
