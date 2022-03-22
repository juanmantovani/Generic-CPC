@extends('adminlte::page')

@section('htmlheader_title')
	Listado de Categorías
@endsection


<meta name="csrf-token" content="{{ csrf_token() }}">



<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">

<!--
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
-->
<!--Datatables botonera agregada-->
<script src="{{ asset ("js/datatables/v1.5.6/dataTables.buttons.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/datatables/v1.5.6/buttons.print.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/datatables/v1.5.6/buttons.colVis.min.js") }}" type="text/javascript"></script>


<!--Datatable pdf agregada
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
-->
<script src="{{ asset ("js/pdf/v0.1.53/pdfmake.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/pdf/v0.1.53/vfs_fonts.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/datatables/v1.5.6/buttons.html5.min.js") }}" type="text/javascript"></script>


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
			<table class="table table-striped table-bordered table-condensed table-hover" id="categorias_tabla">
				<thead>
					<th>Id</th>
					<th>Nombre</th>	
					<th>Descripción</th>
					<th>Opciones</th>
				</thead>
				<tbody>
					
				</tbody>
				
			</table>
			</div>
			
		</div>
	</div>

@endsection
@section('scripts')
<script type="text/javascript">
	$('#categorias_tabla').DataTable( {
		dom: 'Bfrtip',//'lrtip',
		 lengthMenu:				[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		iDisplayLength:			10,
        processing: true,
	    serverSide: true,
	    buttons: [],
	    "ajax":
	    {
	    	"url": '{{ route('todas_las_categorias') }}',
	      	"type": "POST",
	      	"data":{ _token: "{{csrf_token()}}"}
	      },

        aoColumns: [
       // { data: "id","defaultContent":"", "title":"g" },
        { data: "id"},
        { data: "nombre" },
        { data: "descripcion" },
        { data: null,
        	render: function ( data, type, row ) {
		          	var url_show = '{{  URL::action('CategoriaController@show', ':id')}}';
		          		url_show= url_show.replace(':id', data.id); 
		          	var url_edit='{{URL::action('CategoriaController@edit',':id')}}';
		          		url_edit=url_edit.replace(':id',data.id);
	          		var url_action='{{Form::Open(array('action'=>array('CategoriaController@destroy',':id'),'method'=>'delete'))}}';
		          		url_action=url_action.replace(':id',data.id);

		  		  return "<div><a href='"+url_show+"'><button class='btn btn-primary btn-xs' >Ver</button></a><a href='"+url_edit+"'><button class='btn btn-warning btn-xs'>Editar</button></a><a href='' data-target='#modal-delete-"+data.id+"' data-toggle='modal'><button class='btn btn-danger btn-xs'> Eliminar </button></a></div><div class='modal fave modal-slide-in-right' aria-hidden='true' role='dialog' tabindex='-1' id='modal-delete-"+data.id+"'>"+url_action+"<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button class='close' type='button' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button><h4 class='modal-title'>Eliminar Categoría</h4></div><div class='modal-body'><div class='bg-danger text-white'>¡¡ ATENCIÓN !!<br><p>Va a eliminar una Categoria de forma irreversible!!</p><br> Está acción eliminara <strong>TODOS</strong> los productos asociadas a la categoria: <strong><i>"+data.nombre+"</i></strong> ¿Ésta seguro?</div></div><div class='modal-footer'><button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button><button class='btn btn-primary' type='submit'>Confirmar</button></div></div></div></form></div>";
		  		}

        	},
        ],

        aoColumnDefs: [
          { 'bSortable': false, 'aTargets': [3] }
        ],

        order: 
        [
        	[2, 'asc'] //The position of your column and the order
        ],

      	language: {
				select: {
					rows: {
						_: "%d registros seleccionados",
						0: "No se han seleccionado registros",
						1: "1 registro seleccionado"
					}
				},
      		'processing': "Procesando...<i class='fa fa-spinner fa-spin'></i>",
				"emptyTable":			"No hay datos disponibles en la tabla.",
				"info":		   			"Del _START_ al _END_ de _TOTAL_ ",
				"infoEmpty":			"Mostrando 0 registros de un total de 0.",
				"infoFiltered":			"(filtrados de un total de _MAX_ registros)",
				"infoPostFix":			"(actualizados)",
				"lengthMenu":			"Mostrar _MENU_ registros",
				"loadingRecords":		"Cargando...",
				"search":				"Buscar:",
				"searchPlaceholder":	"Dato a buscar",
				"zeroRecords":			"No se han encontrado coincidencias.",
				"paginate": {
					"first":			"Primera",
					"last":				"Última",
					"next":				"Siguiente",
					"previous":			"Anterior"
				},
				"aria": {
					"sortAscending":	"Ordenación ascendente",
					"sortDescending":	"Ordenación descendente"
				}
			},


	} );
</script>

@show
