@extends('adminlte::page')

@section('htmlheader_title')
	Pedidos
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>

<!--
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>-->
<script src="{{ asset ("js/datetime-moment/v1.10.19/datetime-moment.js") }}" type="text/javascript"></script>


@section('main-content')
	<div class="container-fluid spark-screen">

	<div class="row">
			@include('administracion.alerta')
	<div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
		<h3>Listado de Pedidos <a href="administracion/pedidos/create"><button class="btn btn-success">Nuevo</button></a></h3>
	</div> 
</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-bordered " id="pedidos_tabla" >
				<thead >
					<tr>
                        <th>Nº pedido</th>
                        <th>Cliente</th>
						<th>Ciudad</th>
                        <th>Total</th>	
                        <th>Fecha</th>
                        <th>Opciones</th>
				    </tr>
				</thead>
				<tbody>					
				</tbody>
			</table>
			</div>
		</div>
	</div>
	</div>
@endsection
@section('scripts')



<script type="text/javascript">
	$('#pedidos_tabla').DataTable( {
		dom: 'Bfrtip',//'lrtip'
		lengthMenu:				[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		iDisplayLength:			15,
        processing: true,
	    serverSide: true,
	    "ajax":
	    {
	    	"url": '{{ route('todos_los_pedidos') }}',
	      	"type": "POST",
	      	"data":{ _token: "{{csrf_token()}}"}
	    },
        aoColumns: [
        { data: "id"},
        { data: "cliente" },
		{ data: "ciudad" },
        { data: "total" },
        { data: "fecha","render": function ( data, type, row ) 
        	{
        	aux=(moment(data).format('DD/MM/YYYY'));
        		return aux;
        	}
        },
        { data: null,
        	render: function ( data, type, row ) {
              	var url_show = '{{  URL::action('PedidoController@show', ':id')}}';
	          	url_show= url_show.replace(':id', data.id); 

	  		  return "<div><a href='"+url_show+"'><button class='btn btn-primary btn-xs' >Ver</button></a></div>";
	  		}
        }
        ],
		order: [],
        aoColumnDefs: [
          { 'bSortable': false,
			'aTargets': [5] }
        ],  
             buttons: [],
      	"language": {
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
