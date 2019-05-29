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
                <label for="stock">Stock: </label>
                {{$producto->stock}}
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                    {{$producto->descripcion}}
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Fecha de ingreso: </label>
                {{ Carbon\Carbon::parse($producto->fecha_ingreso)->format('d-m-Y') }}
                
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Fecha de vencimiento: </label>
                {{ Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d-m-Y') }}
                </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="imagen">Imagen: </label>
                @if(($producto->imagen)!="")
                    <img src="{{ asset('imagenes/productos/'.$producto->imagen)}} " height="120px">
                @else
                No posee imagen
                @endif
            </div>      
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 form-group">
                <a href="/administracion/productos" class="btn btn-primary"  >Volver</a>
        </div>
    </div>
</div>
@endsection
