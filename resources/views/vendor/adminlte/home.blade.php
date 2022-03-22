@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Panel Administrativo
@endsection
@section('contentheader_title', 'Panel Administrativo')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("js/chart/v2.6.0/Chart.bundle.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/jQuery/jquery-2.2.3.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/jQueryUI/jquery-ui.js") }}" type="text/javascript"></script>

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>


<!--para datatable-->
<script src="{{ asset ("/plugins/datatables/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/plugins/datatables/dataTables.bootstrap.min.js") }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">


<!--Datatables botonera agregada-->
<script src="{{ asset ("js/datatables/v1.5.6/dataTables.buttons.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/datatables/v1.5.6/buttons.print.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("js/datatables/v1.5.6/buttons.colVis.min.js") }}" type="text/javascript"></script>

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
				</div>
    </div>

@endsection

@section('scripts')

@show

