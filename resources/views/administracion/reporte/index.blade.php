@extends('adminlte::page')

@section('htmlheader_title')
	Reportes
@endsection


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>



<!--para datatable-->
<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

<!--Datatable pdf-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>



<!--Para formatear la fecha-->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
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
            		<label>Seleccione la fecha de vencimiento</label>
            		<div>
		        		<div class="col-sm-4">
		        			<input data-date-format="dd/mm/yyyy" name="fecha_vencimiento"  class="form-control" placeholder="Fecha de vencimiento" id="fecha_vencimiento0">
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
            				<input type="text" data-date-format="dd/mm/yyyy" name="fecha_vencimiento"  class="form-control" placeholder="Fecha de vencimiento" id="fecha_vencimiento1" required>
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
			fecha_vencimiento(0);
		}
		else
		{
			if(valor==1)
			{
				bloque1.style.display='block';
				fecha_vencimiento(1)
			}
		}
	}

</script>

<script type="text/javascript">
	function fecha_vencimiento(val){
		$('#fecha_vencimiento'+val).datepicker({
			format:'dd/mm/yyyy',  language: 'es',  autoclose: true, todayHighlight: true, orientation: "top auto"
		}).datepicker("setDate",'now');
	}
</script>

<script type="text/javascript">
	function enviar_datos(campo){
		var fecha_v = $("#fecha_vencimiento"+campo).val();
		var token = '{{ csrf_token() }}';
			var cat = $("#cat").val();
		//console.log(cat);
		
			$.ajax({
			type: "POST",
			url: '{{route("get_vencidos")}}',
			dataType: 'JSON',
			data:{"fecha_v":fecha_v,"cat":cat,"_token":token},
			success: function(data){
				
				var filas=data.productos.length;
				document.getElementById("tabla_resultados").innerHTML="";
				for(i=0; i<filas; i++){
					var display_results = $("#tabla_resultados");
					var results = '<table id="tabla_de_los_resultados" class="table table-striped table-hover">';
					results += '<thead> <tr> <th>id</th> <th>Categoria</th> <th>Codigo</th> <th>Nombre</th>';
					results += '<th>Fecha Vencimiento</th> <th>Opciones</th> </tr> </thead> <tbody>';

					if (data.productos.length != 0)
						{
						for(i=0; i<filas; i++){
		  					results += '<tr>';
		  					results +='<td>' + data.productos[i].id + '</td>';
		  					results +='<td>' + data.productos[i].categoria_id + '</td>';
							results +='<td>' + data.productos[i].codigo + '</td>';		
		  					results +='<td>' + data.productos[i].nombre + '</td>';
							aux=(moment(data.productos[i].fecha_vencimiento).format('DD-MM-YYYY'));
		  					results +='<td>' + aux  + '</td>';
		  					results +='<td>';
		  					results +='<a href="" data-bubble="' + data.productos[i].id + '" class="btn btn-xs btn-primary"> <i class="fa fa-calendar-o"></i>  Ver mas</a>';
		  					results +='</td>'; 
		  					results +='</tr>';	
						};
						results += '</tbody></table>';
						display_results.append(results);
						carga_datatable();
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
        	         "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
			    },
			} );
	}
</script>

@show

