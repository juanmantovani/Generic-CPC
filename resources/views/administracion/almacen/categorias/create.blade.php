
	@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

@section('contentheader_title', 'Creacion de nuevo producto')


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Categoría</h3>
				@if (count($errors)>0)
				<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
				</div>
				@endif
				<!--CategoriaController, si el metodo es POST llama a la funcion store, si el metodo es path va a llamar a la funcion update, si el metodo es  delete llama a la funcion destroy-->
				{!!Form::open(array('action'=>'CategoriaController@store','method'=>'POST','autocomplete'=>'off'))!!}
				{{Form::token()}}
				<!--Usado en modal para que se pueda agregar desde productos una nueva categoria-->
				@include('administracion.almacen.categorias.form.formulario-categoria')

				<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a class="btn btn-danger" href="{{ action('CategoriaController@index') }}" type="reset">Cancelar</a>
				</div>
				{!!Form::close()!!}
			</div>	
		</div>

	</div>
@endsection