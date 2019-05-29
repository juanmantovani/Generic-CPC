@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Panel Administrativo
@endsection
@section('contentheader_title', 'Panel Administrativo')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script src="{{ asset ("/plugins/jQuery/jquery-2.2.3.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/jQueryUI/jquery-ui.js") }}" type="text/javascript"></script>


<!--Para formatear la fecha-->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>

        
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
      <div class="col-md-5 col-md-offset-1">
           <div class="panel panel-default">
               <div class="panel-heading"><b>Productos proximos a vencer</b></div>
               <div class="panel-body">
                   <canvas id="canvas" height="280" width="600"></canvas>
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
                Years.push(moment(data.fecha_vencimiento).format('DD-MM-YYYY'));
                         //  aux=(moment(data.productos[i].fecha_vencimiento).format('DD-MM-YYYY'));
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
                          label: 'Stock del producto',
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
                              labelString: "Cantidad de productos",
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
        });


</script>
@show

