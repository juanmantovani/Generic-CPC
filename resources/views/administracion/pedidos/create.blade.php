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

<link rel="stylesheet" href="{{ asset ("/plugins/select2/select2.css") }}">
<script src="{{ asset ("/plugins/select2/select2.min.js") }}" type="text/javascript"></script>

@section('main-content')
<div class="container-fluid spark-screen" id="contenedor">
    <div class="row">
          @include('administracion.alerta')
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Pedido</h3>

        </div>
    </div>

    {!!Form::open(array('action'=>'PedidoController@store','method'=>'POST','autocomplete'=>'off','files'=>'true', 'id' => 'formId'))!!}
    {{Form::token()}}
    <div class="row" >
    <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Cliente</label>
                    <select class="idCliente form-control" name="idCliente" id="idCliente" required></select>
                </div>      
            </div>
        </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 bloque">
            <div class="form-group">
                <label for="codigo">Codigo</label>
                <input type="text" id="codigo" class="form-control" placeholder="Codigo...">
            </div>  
        </div>

    
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 bloque">
            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" id="total" class="form-control" disabled>
            </div>  
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered" id="tablaProductos">
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Suma</th>
                <th></th>
            </tr>
        </table>
    </div>

    <div  class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
            <button type="button" class="btn btn-secondary"> <a  href="{{route('home')}}" style="text-decoration:none;color:black" >Volver</a> </button>
                <a href="#" class="btn btn-primary" onClick='onConfirmar()' data-toggle="modal"  data-target="#confirmar_pedido" type="submit">Confirmar</a>
            </div>
        </div>
    </div>
    
    {!!Form::close()!!}

</div>
@include('administracion.pedidos.confirmar')
@endsection

@section('scripts')

@include('administracion.pedidos.scriptJS')

@show
