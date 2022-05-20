@extends('adminlte::page')

@section('htmlheader_title')
Nuevo Producto
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

<!--Para formatear la fecha
    background:url({ { asset ("/img/bootstrap-datepicker.js") }}check_radio_sheet.png) -19px top no-repeat;
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
-->

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>

@section('main-content')
<div class="container-fluid spark-screen" id="contenedor">
    <div class="row">
          @include('administracion.alerta')
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Producto</h3>

        </div>
    </div>

    {!!Form::open(array('action'=>'ProductoController@store','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
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
                    <label>Categoría</label>
                    <select name="idcategoria" class="form-control" required><!--con el name se valida en el ProductoFormRequest-->
                        <!--voy a recibir todas las categorias en una variable $categorias desde el metodo create de ProductoController-->
                         <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $cat)
                            <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                        @endforeach
                    </select>
                    <a href="#" data-toggle="modal" data-target=".pop-up-1" data-cliente="" class="btn btn-xs btn-danger pull-left" role="button"> Agregar Categoria</a>
                </div>      
            </div>
        
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Código del producto...">
                </div>                      
            </div>
           
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" required value="{{old('precio')}}" class="form-control" placeholder="Precio del producto...">
                </div>      
            </div>
        
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del producto...">
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
