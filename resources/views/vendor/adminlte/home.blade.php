@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Panel Administrativo
@endsection
@section('contentheader_title', 'Panel Administrativo')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
<!-- Grafico
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
-->
<script src="{{ asset ("js/chart/v2.6.0/Chart.bundle.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/jQuery/jquery-2.2.3.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/jQueryUI/jquery-ui.js") }}" type="text/javascript"></script>


<!--Para formatear la fecha
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
-->

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>


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




        
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
      @include('administracion.alerta')

			<div class="col-md-8 col-md-offset-2">

				<!-- Default box -->
				<div class="box box-solid box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Panel administrativo</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						Bienvenido {{ $user->name }}. 
					</div>
					<!-- /.box-body -->
				</div>
						
              		 
				<!-- /.box -->
			</div>
      <div class="row">
        <div class="col-md-8 ">
          <div class="panel panel-default">
            <div class="panel-heading"><b>Productos próximos a vencer (retiro de gondola)</b></div>
            <div class="panel-body">
              <div id="tabla-detallado" class="table-responsive"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 ">
          <div class="panel panel-default">
            <div class="panel-heading"><b>Cantidad de Stock de productos próximos a vencer por dia</b></div>
            <div class="panel-body">
              <canvas id="canvas" height="280" width="600"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">

//           var ctx = document.getElementById("canvas").getContext("2d");

           var ctx = document.getElementById("canvas").getContext("2d");
         
        var url = "{{route('vencimientos_chart')}}";
        var Years = new Array();
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Years.push(moment(data.fecha_retiro_gondola).format('D/M/YYYY'));
                         //  aux=(moment(data.productos[i].fecha_venci1miento).format('DD-MM-YYYY'));
                Labels.push(data.nombre);
                Prices.push(data.stock);
            });
                //var myChart = new Chart(ctx, {
                  var options_aux= {
                  type: 'bar',
                  data: {
                      labels:Years,
                      datasets: [{
                        scaleStepWidth:1,
                          label: 'Stock de productos',
                          data: Prices,
                           backgroundColor: 
                                'rgba(54, 162, 235, 0.2)',
                            
                            borderColor: 
                                'rgba(0, 0, 0, 1)',
                            
                            
                          borderWidth: 1,
                          scale: 1,
                      }]
                  },
                  options: {
                      scales: {
                        xAxes: [{
                            gridLines: {
                              display: false,
                              color: "black"
                            },
                            scaleLabel: {
                              display: true,
                              labelString: "Fecha de vencimiento de productos",
                              fontColor: "red"
                            }
                          }],
                          yAxes: 
                          [{
                            scaleLabel: {
                              display: true,
                              labelString: "Stock de productos",
                              fontColor: "red"
                            },
                              ticks: {
                                steps: 10,
                                  beginAtZero:true
                              }
                          }

                          ]

                      }
                  }
              }; 
            
            new Chart(ctx, options_aux);
          });

//Aca empieza la otra tabla... JUNTOS, separados duplica
      $.ajax({
      type: "GET",
      url: '{{route("detalle_proximos_vto")}}',
      dataType: 'JSON',
      success: function(data){
        document.getElementById("tabla-detallado").innerHTML="";
        var display_results = $("#tabla-detallado");
        var results = '<div>';
        var filas=data.productos.length;
      
        results+='<table id="tabla_de_los_resultados" class="table  table-hover table-bordered">';
        results += '<thead>';
        results+='<tr align="left"><td><strong>Fecha</strong></td> <td><strong>Producto</strong></td><td><strong>Stock</strong></td></tr> </thead><tbody>';
        data.productos.forEach(function(elemento, indice) {
          elemento.forEach(function(element2,indice2){
            aux=(moment(element2.fecha_retiro_gondola).format('DD-MM-YYYY'));
            results +='<tr><td>'+aux+'</td><td>'+element2.nombre+'</td><td>'+element2.stock+'</td></tr>';
          });
        });
        results += '</tbody></table>';

        results += '</div>';
        display_results.append(results);
        carga_datatable();
      }
    });

    });//Del document ready
</script>

<script type="text/javascript">
  function carga_datatable(){
    $('#tabla_de_los_resultados').DataTable( {
        processing: true,
         
        language: {
                   
                   select: {
          rows: {
            _: "%d registros seleccionados",
            0: "No se han seleccionado registros",
            1: "1 registro seleccionado"
          }
        },
          'processing': "Procesando...<i class='fa fa-spinner fa-spin'></i>",
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":           "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "(filtrados de un total de _MAX_ registros)",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "search":       "Buscar:",
        "searchPlaceholder":  "Dato a buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
          },
      } );
  }
</script>
@show

