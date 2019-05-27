@extends('adminlte::page')

@section('htmlheader_title')
	Productos
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">



<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<!--los de abajo son para los botones csv excel pdf
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>

--->
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">

				<div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Example box</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Listado de productos
                    </div>
                    <!-- /.box-body -->
                </div>
			</div>
		</div>
	<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
		<h3>Listado de Productos <a href="productos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		<!--//se incluye la vista search.blade.php-->
		
		<!-- @ include('almacen.articulo.search')-->
	</div> 
</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover display" id="productos_tabla">
				<thead>
					<th>Id</th>
					<th>Nombre</th>	
					<th>Código</th>	
					<th>Categoria</th>	
					<th>Stock</th>	
					<th>Imagen</th>	
					<th>Estado</th>
					<th>Fecha ingreso</th>	
					<th>Fecha Vencimiento</th>		
					<th>Opciones</th>
				</thead>
				@foreach($productos as $unproducto)
				<tr>
					<td>{{$unproducto->id}}</td>
					<td>{{$unproducto->nombre}}</td>
					<td>{{$unproducto->codigo}}</td>
					<td>{{$unproducto->cate_nombre}}</td>
					<td>{{$unproducto->stock}}</td>
					<td>
						<img src="{{asset('imagenes/productos/'.$unproducto->imagen)}}" alt="{{$unproducto->nombre}}" width="100px" class="img/"><!--asset busca en la carpeta publica alto height="100px"-->
					</td>
					<td>{{$unproducto->estado}}</td>
					<td>{{$unproducto->fecha_vencimiento}}</td>
					<td>{{$unproducto->fecha_vencimiento}}</td>
					<td>

                    	<a href="{{URL::action('ProductoController@edit',$unproducto->id)}}"><button class="btn btn-info">Editar</button></a>
                    	<a href="{{URL::action('ProductoController@show',$unproducto->id)}}"><button class="btn btn-primary">Ver</button></a>
                    	<a href="" data-target="#modal-delete-{{$unproducto->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('administracion.almacen.productos.modal')
				@endforeach
			</table>
			</div>
			{{$productos->render()}}
		</div>
	</div>
	</div>
@endsection
@section('scripts')


<script>


	    $('#productos_tabla').DataTable( {
        dom: 'Bfrtip',
        processing: true,
       /* serverSide: true,
        stateSave: true,*/
        buttons: 
        [
        { 
        	extend: 'print',
        	text:'Imprimir',
        	messageTop: 'Impresion de listado de productos',
        	exportOptions: {
        		columns: ':visible', stripNewlines: true
        	}
        },
        {
	       	extend: 'colvis',
	       	text: ' Ocultar coulmnas',
	        columnText: function (dt, idx, title) 
		        {
	    	    	return (idx + 1) + ': ' + title;
	        	},
	        postfixButtons:[{extend: 'colvisGroup', text:'Restablecer',show:':hidden'}],

        },
        ],
      /* Para ocultar columnas por defecto
      	columnDefs: [ {
        	targets: -1,
        	visible: false
        } ],*/
        language: {
        	         "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			    },
			} );
</script>

@show

