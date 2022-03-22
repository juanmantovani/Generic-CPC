@extends('adminlte::page')

@section('htmlheader_title')
	Viendo producto
@endsection




@section('main-content')
<div class="container-fluid spark-screen">
    <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
        <h3>Viendo producto:  {{ $producto->nombre }} <a href='/administracion/productos/{{ $producto->id }}/edit'>
            <button class="btn btn-warning">Editar</button></a></h3>
    </div> 
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">Nombre: </label>
               {{$producto->nombre}}
            </div>  
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Pertenece a la categoría: </label>
                @if($categoria!=null)
                    {{ $categoria->nombre }}
                    @endif
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="codigo">Código: </label>
                {{$producto->codigo}}
            </div>                      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="precio">Precio: </label>
                {{$producto->precio}}
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                    {{$producto->descripcion}}
            </div>      
        </div>    
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 form-group">
                <a href="/administracion/productos" class="btn btn-primary"  >Volver</a>
    </div>
</div>
@endsection
