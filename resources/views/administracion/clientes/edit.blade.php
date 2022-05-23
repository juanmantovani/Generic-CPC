@extends('adminlte::page')

@section('htmlheader_title')
	Editando cliente
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>

<style type="text/css">
input[type="radio"] + label  {
    display:inline-block;
    width:19px;
    height:19px;
    margin:-1px 4px 0 0;
    vertical-align:middle;
    cursor:pointer;
}
input[type="radio"]:checked + label  {}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }
</style>


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			
            <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Cliente: {{$cliente->nombre}}</h3>
            
        </div><!--columna-->
    </div><!--fila-->
           
            {!!Form::model($cliente,['method'=>'PATCH','action'=>['ClienteController@update',$cliente->id],'files'=>'true'])!!}

            {{Form::token()}}
            <div class="row">
                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{$cliente->nombre}}" class="form-control" placeholder="{{$cliente->nombre}}">
                    </div>  
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="razon_social">Razon social</label>
                        <input type="text" name="razon_social" required value="{{$cliente->razon_social}}" class="form-control" placeholder="{{$cliente->razon_social}}">
                    </div>  
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="number" name="dni" required value="{{$cliente->dni}}" class="form-control" placeholder="{{$cliente->dni}}">
                    </div>  
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="cuil">Cuil</label>
                        <input type="text" name="cuil" required value="{{$cliente->cuil}}" class="form-control" placeholder="{{$cliente->cuil}}">
                    </div>  
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" required value="{{$cliente->direccion}}" class="form-control" placeholder="{{$cliente->direccion}}">
                    </div>  
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Ciudades</label>
                        <select name="idciudad" class="form-control" required>
                            @foreach ($ciudades as $ciudad)
                                @if ($ciudad->id==$cliente->ciudad_id)
                                <option value="{{$ciudad->id}}" selected>{{$ciudad->nombre}}</option><
                                @else
                                <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>      
                </div>
            </div>
            
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                       <a class="btn btn-danger" href="{{ action('ClienteController@index') }}" type="reset">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
            {!!Form::close()!!}
	</div>

@endsection