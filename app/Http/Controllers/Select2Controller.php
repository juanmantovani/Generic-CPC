<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Persona;

class Select2Controller extends Controller
{
    public function dataAjaxCliente (Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Persona::select("id","nombre")
            ->where('nombre','LIKE',"%$search%")
            ->where('tipo',1)
            ->get();
        }
        return response()->json($data);
    }
}
