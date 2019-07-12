@extends('adminlte::page')

@section('htmlheader_title')
	Editando una categoría
@endsection


@section('contentheader_title', 'Edición de nueva Categoría')


<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

@section('main-content')
	<div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Categoría: {{$categoria->nombre}}</h3>
               
                {!!Form::model($categoria,['method'=>'PATCH','action'=>['CategoriaController@update',$categoria->id]])!!}
                {{Form::token()}}
                @include('administracion.almacen.categorias.form.formulario-categoria')
                <div id="alerta-modifcacion">
                   
                </div>

                <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="{{ action('CategoriaController@index') }}" type="reset">Cancelar</a>
                 </div>
                {!!Form::close()!!}
            </div>  
        </div>
	</div>
@endsection
@section('scripts')
<script type="text/javascript">
// $('document').ready(function(){
$("input[type='radio']").click(function (event) {
        valor = $('input:radio[name=condicion]:checked').val()
            if(valor==0){
           //document.getElementById("alerta-modifcacion").style.display="block";
                document.getElementById("alerta-modifcacion").innerHTML="";
                var display_results = $("#alerta-modifcacion");
                var results = '<div> <p ><label class="bg-danger">Todos los productos asociados a esta categoría se estableceran con estado <strong>INACTIVO</strong> </label></p></div>';
                display_results.append(results);
        } else {
            //document.getElementById("alerta-modifcacion").style.display="none";
             document.getElementById("alerta-modifcacion").innerHTML="";
             var display_results = $("#alerta-modifcacion");
                var results = '<div> <p ><label class="bg-danger">Todos los productos asociados a esta categoría se estableceran con estado <strong>ACTIVO</strong> </label></p></div>';
                display_results.append(results);
         
        }
    });
  //});
</script>
@show
