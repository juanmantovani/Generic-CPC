@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

@section('contentheader_title', 'Listado de producto')

@section('main-content')
	<div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Categoría: {{$categoria->nombre}}</h3>
                @if (count($errors)>0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
                </div>
                @endif
                 <div class="form-group">
                    <label for="nombre">Nombre</label>
                                <!--nombre es recibido por CategoriaFormRequest en la funcion rules() 8-36 8:08 y tambien sera usado por CategoriaController en el metodo store() -->
                 {{$categoria->nombre}}
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <!--nombre es recibido por CategoriaFormRequest en la funcion rules()-->
                   {{$categoria->descripcion}}
                </div>
                <div class="form-group">
                    <a href="/administracion/categorias" class="btn btn-primary"  >Volver</a>
                </div>

            </div>  
        </div>
	</div>
@endsection
