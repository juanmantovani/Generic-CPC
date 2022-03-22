@extends('adminlte::page')

@section('htmlheader_title')
Editando producto
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>

<style type="text/css">
    input[type="radio"]+label {
        display: inline-block;
        width: 19px;
        height: 19px;
        margin: -1px 4px 0 0;
        vertical-align: middle;
        cursor: pointer;
    }

    input[type="radio"]:checked+label {}
</style>

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Editar Producto: {{$producto->nombre}}</h3>
            </div>
        </div>

        {!!Form::model($producto,['method'=>'PATCH','action'=>['ProductoController@update',$producto->id],'files'=>'true'])!!}

        {{Form::token()}}
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required value="{{$producto->nombre}}" class="form-control" placeholder="{{$producto->nombre}}">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Categoría</label>
                    <select name="idcategoria" class="form-control" required>
                        @foreach ($categorias as $unacategoria)
                        @if ($unacategoria->id==$producto->categoria_id)
                        <option value="{{$unacategoria->id}}" selected>{{$unacategoria->nombre}}</option>
                        < @else <option value="{{$unacategoria->id}}">{{$unacategoria->nombre}}</option>
                            @endif
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{$producto->codigo}}" class="form-control" placeholder="{{$producto->codigo}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" required value="{{$producto->precio}}" class="form-control" placeholder="{{$producto->precio}}" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" value="{{$producto->descripcion}}" class="form-control" placeholder="Descripción del artículo...">
                </div>
            </div>

        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <a class="btn btn-danger" href="{{ action('ProductoController@index') }}" type="reset">Cancelar</a>
                </div>
            </div>
    </div>
    {!!Form::close()!!}
</div>

@endsection

@section('scripts')
@show