@extends('adminlte::page')

@section('htmlheader_title')
	Viendo cliente
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
        <h3>Viendo cliente:  {{ $cliente->nombre }} <a href='/administracion/clientes/{{ $cliente->id }}/edit'>
            <button class="btn btn-warning">Editar</button></a></h3>
    </div> 
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre: </label>
               {{$cliente->nombre}}
            </div>  
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="razon_social">Razon social: </label>
                {{$cliente->razon_social}}
            </div>                      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="dni">DNI: </label>
                {{$cliente->dni}}
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cuil">Cuil:</label>
                    {{$cliente->cuil}}
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                    {{$cliente->direccion}}
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Pertenece a la ciudad: </label>
                @if($ciudad!=null)
                    {{ $ciudad->nombre }}
                    @endif
            </div>      
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 form-group">
                <a href="/administracion/clientes" class="btn btn-primary"  >Volver</a>
        </div>
    </div>
</div>
@endsection
