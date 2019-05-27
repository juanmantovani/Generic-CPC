
	@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection


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
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<!--nombre es recibido por CategoriaFormRequest en la funcion rules() 8-36 8:08 y tambien sera usado por CategoriaController en el metodo store() -->
					<input type="text" name="nombre" class="form-control" placeholder="Nombre..">
				</div>
				<div class="form-group">
					<label for="descripcion">Descripcion</label>
					<!--nombre es recibido por CategoriaFormRequest en la funcion rules()-->
					<input type="text" name="descripcion" class="form-control" placeholder="Descripcion..">
				</div>
				<div class="form-group">
					<label for="condicion">Condicion</label><br>
					<!--nombre es recibido por CategoriaFormRequest en la funcion rules()-->
					<input type="checkbox" name="condicion"  id="condicion1" value="1" checked><label for="condicion1">Activo</label>

					<input type="checkbox" name="condicion"  id="condicion0" value="0"><label for="condicion0">Inactivo</label>
				</div>
				<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
				{!!Form::close()!!}
			</div>	
		</div>

	</div>
@endsection