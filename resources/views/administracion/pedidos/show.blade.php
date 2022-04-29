@extends('adminlte::page')

@section('htmlheader_title')
Pedido
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
<div>
<button type="button" class="btn btn-secondary"> <a  href="{{route('home')}}" style="text-decoration:none;color:black" >Volver</a> </button>
<button class="btn btn-primary" onClick="printDiv('areaImprimir')">Imprimir</button>
</div>
<br>

<div class="row" >

<div id="areaImprimir">
             <div class=row>
                <span class="col-md-6"><strong>Cliente: </strong>{{$pedido[0]->nombre}}</span>
                <span class="col-md-6"><strong>Razon Social: </strong>{{$pedido[0]->razon_social}} - {{$pedido[0]->cuil}}</span>
                <span class="col-md-12"><strong>Dirección: </strong>{{$pedido[0]->direccion}} - {{$pedido[0]->ciudad}}</span>
             </div>
             <div class=row>
             <span class="col-md-6"><strong>Fecha: </strong>{{ Carbon\Carbon::parse($pedido[0]->fecha)->format('d-m-Y') }}</span>
             <span class="col-md-6"><strong>Total: $</strong>{{$pedido[0]->total}}</span>

            </div>
        <table class="table table-striped table-bordered" id="tablaProductosConfirmar">
        <thead>    
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Suma</th>
            </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                <td>{{$producto->codigo}}</td>
                <td>{{$producto->producto}}</td>
                <td>{{$producto->precio}}</td>
                <td>{{$producto->cantidad}}</td>
                <td>{{$producto->precio * $producto->cantidad}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

<script>
  function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>

