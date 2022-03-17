@extends('adminlte::page')

@section('htmlheader_title')
Nuevo Cliente
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
            <h3>Nuevo Cliente</h3>
        </div>
    </div>

    {!!Form::open(array('action'=>'ClienteController@store','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
    <div class="row" >
        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
                </div>  
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="razon_social">Razon social</label>
                    <input type="text" name="razon_social" required value="{{old('razon_social')}}" class="form-control" placeholder="Razon social...">
                </div>  
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" required value="{{old('dni')}}" class="form-control" placeholder="DNI...">
                </div>  
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="cuil">Cuil</label>
                    <input type="text" name="cuil" required value="{{old('cuil')}}" class="form-control" placeholder="Cuil...">
                </div>  
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Dirección...">
                </div>  
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Ciudad</label>
                    <select name="idciudad" class="form-control">
                         <option value="">Seleccione una ciudad</option>
                        @foreach ($ciudades as $ciu)
                            <option value="{{$ciu->id}}">{{$ciu->nombre}}</option>
                        @endforeach
                    </select>
                    <a href="#" data-toggle="modal" data-target=".pop-up-1" data-cliente="" class="btn btn-xs btn-danger pull-left" role="button"> Agregar Ciudad</a>
                </div>      
            </div>
        </div>

        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                     <a class="btn btn-danger" href="{{ action('ClienteController@index') }}" type="reset">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    
    {!!Form::close()!!}

</div>
<!--Usado en modal para que se pueda agregar desde clientes una nueva ciudad-->
@include('administracion.clientes.modal.agregar-ciu')
    
@endsection

@section('scripts')

<!--Para agregar la ciudad por modal-->
<script type="text/javascript">
  function enviar_datos(){
    var token = '{{ csrf_token() }}';
    var ciu = $("#ciu-nombre").val();
    
    $.ajax({
    type: "POST",
    url: '{{route("store_ajax_modal_ciudad")}}',
    dataType: 'JSON',
    data:{"nombre":ciu,"_token":token},
    success: function(data){
    window.location.reload(true);
    }
    });
  }
</script>
@show
