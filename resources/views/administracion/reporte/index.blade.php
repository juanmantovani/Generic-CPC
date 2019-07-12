@extends('adminlte::page')

@section('htmlheader_title')
	Reportes
@endsection


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
<!--Version español de datapicker
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>-->
<script src="{{ asset ("js/datapicker/v1.9.0/bootstrap-datepicker.es.min.js") }}" type="text/javascript"></script>

<!--para datatable-->
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



<!--Para formatear la fecha
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
-->

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">


@include('administracion.alerta')


			<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                    <label for="title">Seleccione el tipo de reporte a realizar</label>
                   <div class="">
						<input type="radio" id="tipo_reporte" name="tipo_reporte" value="0" onclick="genera_reporte(0)">
						<label for="productos">Por productos</label>
					</div>

					<div class="" >
						<input type="radio" id="tipo_reporte" name="tipo_reporte" value="1" onclick="genera_reporte(1)">
						<label for="categorias">Por categorias</label>
					</div>
                </div>  
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 form-group">
            	<div id="seleccionado-0" style="display:none;">
            		<label>Seleccione la fecha de vencimiento de retiro de gondola</label>
            		<div>
		        		<div class="col-sm-4">
		        			<input data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola"  class="form-control" placeholder="Fecha de vencimiento" id="fecha_retiro_gondola0">
		        		</div>
		        		<div class="form-group col-sm-2" onclick="enviar_datos(0)">
		        			<a href="#" class="btn btn-primary"  >Listar</a>
	        			</div>
	        		</div>
            	</div>
            	<div id="seleccionado-1" style="display:none;" class="form-group">
            		<label>Seleccione por categorias con la fecha de vencimiento</label>
            		<div>
            			<div class="col-sm-4">
            				<input type="text" data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola"  class="form-control" placeholder="Fecha de vencimiento" id="fecha_retiro_gondola1" required>
            			</div>
            			<div class="form-group col-sm-6">
            				<select  id="cat" name="cat" required>
            					<option value="">Seleccione una categoria</option>
            					@foreach($categorias as $unacategoria)
            					<option value="{{ $unacategoria->id }}">{{ $unacategoria->nombre }}</option>
            					@endforeach
            				</select>
            			</div>
            			<div class="form-group col-sm-2" onclick="enviar_datos(1)">
            				<a href="#" class="btn btn-primary"  >Listar</a>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tabla_resultados" >
				<div class="table-responsive">

					</div>
					

				</div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
	function genera_reporte(valor) {
		var bloque0 = document.getElementById('seleccionado-0');
		var bloque1 = document.getElementById('seleccionado-1');
		//0 productos, 1 categorias
		bloque0.style.display='none';
		bloque1.style.display='none';

		if(valor==0){
			bloque0.style.display='block';
			fecha_vencimiento_gondola(0);
		}
		else
		{
			if(valor==1)
			{
				bloque1.style.display='block';
				fecha_vencimiento_gondola(1)
			}
		}
	}

</script>


<script type="text/javascript">
	function fecha_vencimiento_gondola(val){

		$('#fecha_retiro_gondola'+val).datepicker({
			format:'dd/mm/yyyy',  
			language: 'es',  
			autoclose: true, 
			todayHighlight: true, 
			orientation: "top auto",
			showButtonPanel: false,
			changeMonth: false,
			changeYear: false,
			inline: true
		}).datepicker("setDate",'now');

	}
</script>

<script type="text/javascript">
	function enviar_datos(campo){
		document.getElementById("tabla_resultados").innerHTML="";
		var fecha_r = $("#fecha_retiro_gondola"+campo).val();
		var token = '{{ csrf_token() }}';
			var cat = $("#cat").val();
		//console.log(cat);
		
			$.ajax({
			type: "POST",
			url: '{{route("get_vencidos")}}',
			dataType: 'JSON',
			data:{"fecha_r":fecha_r,"cat":cat,"_token":token},
			success: function(data){
				if(data.productos==0)
				{
					document.getElementById("tabla_resultados").innerHTML="";
					var display_results = $("#tabla_resultados");
					var results = '<div>';
					results += '<span class="label-primary">No posee productos con vencimientos en la fecha establecida</span>';
					results += '</div>';
					display_results.append(results);
				}
				else
				{
				
					var filas=data.productos.length;
					document.getElementById("tabla_resultados").innerHTML="";
					for(i=0; i<filas; i++)
					{
						var display_results = $("#tabla_resultados");
						var results = '<div>';
						results += '{{ Form::open(array('route' => 'bajas')) }}';
						results += '{{ Form::token() }}';
						results += '<div class="row">';
						results += '<div class="col-md-push-2">';
						results += '<span class="label-primary">Seleccione los productos a dar de baja</span>';
						results += '</div>';
						results += '<div class="col-md-pull-3">';
						results += '<button type="submit" class="btn btn-danger">Dar de baja</button>';
						results += '</div>';
						results += '</div>';
						results += '</br>';
						results += '<table id="tabla_de_los_resultados" class="table table-striped table-hover">';
						results += '<thead> <tr> <th> </th> <th>id</th> <th>Categoria</th> <th>Codigo</th> <th>Producto</th>';
						results += '<th>Fecha Vencimiento de gondola</th> <th>Opciones</th> </tr> </thead> <tbody>';

						if (data.productos.length != 0)
							{
							for(i=0; i<filas; i++){
			  					results += '<tr>';
			  					results +='<td> <input type="checkbox" id="cbox2" name="baja[]" value="'+ data.productos[i].id+' "></td>';
			  					results +='<td>' + data.productos[i].id + '</td>';
			  					results +='<td>' + data.productos[i].nombre_categoria + '</td>';
								results +='<td>' + data.productos[i].codigo + '</td>';		
			  					results +='<td>' + data.productos[i].nombre + '</td>';
								aux=(moment(data.productos[i].fecha_retiro_gondola).format('DD-MM-YYYY'));
			  					results +='<td>' + aux  + '</td>';
			  					results +='<td>';
			  					results +='<div class="dropdown"><a class="btn btn-xs btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-calendar-o"></i>  Ver mas</a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
			  					var url = '{{ action('ProductoController@show',":id") }}';
			  					url= url.replace(':id', data.productos[i].id); 
			  					results +='<a class="dropdown-item btn btn-xs btn-success" href="'+url+'"><i class="fa fa-product-hunt"></i> Producto</a><br>';

			  					results+='<a class="dropdown-item btn btn-xs btn-info" href="/administracion/categorias/'+data.productos[i].categoria_id+'"><i class="fa fa-navicon"></i> Categoria</a>';
			  					results+='</div></div>';
			  					results +='</td>'; 
			  					results +='</tr>';	
							};
							results += '</tbody></table>';
							
							results += '{{ Form::close() }}';
							results += '</div>';
							display_results.append(results);
							carga_datatable();
						} 
					}
				}
			}
		});
	}
</script>
<script type="text/javascript">
	function carga_datatable(){
		$('#tabla_de_los_resultados').DataTable( {
        dom: 'Bfrtip',
        processing: true,
        buttons: 
        [
        { 
        	extend: 'print',
        	text:'Imprimir',
        	messageTop: 'Impresion de listado de productos con vencimiento',
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
        { 
        	extend: 'pdfHtml5',
        	text:'PDF',
        	messageTop: 'Impresion de listado de productos con vencimiento',
        	exportOptions: {
        		columns: ':visible', stripNewlines: true
        	}
        },
        ],
      /* Para ocultar columnas por defecto
      	columnDefs: [ {
        	targets: -1,
        	visible: false
        } ],*/
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
	}
</script>

@show

