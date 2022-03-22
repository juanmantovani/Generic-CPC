@extends('adminlte::page')

@section('htmlheader_title')
Nuevo Pedido
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">

<style type="text/css">
input[type="radio"] + label  {
    display:inline-block;
    width:19px;
    height:19px;
    margin:-1px 4px 0 0;
    vertical-align:middle;
    cursor:pointer;
}
input[type="radio"]:checked + label  {
}
</style>


<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>

@section('main-content')
<div class="container-fluid spark-screen" id="contenedor">
    <div class="row">
          @include('administracion.alerta')
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Pedido</h3>

        </div>
    </div>

    {!!Form::open(array('action'=>'PedidoController@store','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
    <div class="row" >
        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Cliente</label>
                    <select name="idcliente" class="form-control">
                         <option value="">Seleccione un cliente</option>
                        @foreach ($clientes as $cli)
                            <option value="{{$cli->id}}">{{$cli->nombre}}</option>
                        @endforeach
                    </select>
                </div>      
            </div>
        </div>
        
                   
          
        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                     <a class="btn btn-danger" href="{{ action('ProductoController@index') }}" type="reset">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    
    {!!Form::close()!!}


</div>
<!--Usado en modal para que se pueda agregar desde productos una nueva categoria-->
@include('administracion.almacen.productos.modal.agregar-cat')
    
@endsection
@section('scripts')

<!--Para agregar la categoria por modal-->
<script type="text/javascript">
  function enviar_datos(){
    
    var token = '{{ csrf_token() }}';
        var cat = $("#cat-nombre").val();
        var descripcion = $("#cat-descripcion").val();
    
        $.ajax({
        type: "POST",
        url: '{{route("store_ajax_modal")}}',
        dataType: 'JSON',
        data:{"nombre":cat,"descripcion":descripcion,"_token":token},
        success: function(data){
        window.location.reload(true);
        }
    });
  }
</script>
@show
