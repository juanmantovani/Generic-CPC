@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection

@section('contentheader_title', 'Listado productos')

@section('main-content')

<div class="row">
	@include('administracion.alerta')
	
	<div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
		<h3>Listado de Categorías <a href="categorias/create"><button class="btn btn-success">Nuevo</button></a></h3>

	</div> 
</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>	
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
				@foreach($categorias as $unacategoria)
				<tr>
					<td>{{$unacategoria->id}}</td>
					<td>{{$unacategoria->nombre}}</td>
					<td>{{$unacategoria->descripcion}}</td>
					<td>

                    <a href="{{URL::action('CategoriaController@edit',$unacategoria->id)}}"><button class="btn btn-info">Editar</button></a>
                    <a href="{{URL::action('CategoriaController@show',$unacategoria->id)}}"><button class="btn btn-primary">Ver</button></a>
                    <a href="" data-target="#modal-delete-{{$unacategoria->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('administracion.almacen.categorias.modal')
				@endforeach
			</table>
			</div>
			{{$categorias->render()}}

		</div>
	</div>

@endsection