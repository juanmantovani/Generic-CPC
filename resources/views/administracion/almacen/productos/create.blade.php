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
                    <select name="idcategoria" class="form-control"><!--con el name se valida en el ProductoFormRequest-->
                        <!--voy a recibir todas las categorias en una variable $categorias desde el metodo create de ProductoController-->
                         <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $cat)
                            <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                        @endforeach
                    </select>
                    <a href="#" data-toggle="modal" data-target=".pop-up-1" data-cliente="" class="btn btn-xs btn-danger pull-left" role="button"> Agregar Categoria</a>
                </div>      
            </div>
        </div>

        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Código del producto...">
                </div>                      
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del producto...">
                </div>      
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del producto...">
                </div>              
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="descripcion">Fecha de ingreso</label>
                    <input data-date-format="dd/mm/yyyy" name="fecha_ingreso" required class="form-control" placeholder="Fecha de ingreso del producto..." id="fecha_ingreso">
                </div>      
            </div>
        </div>

        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group" class="input-group date">
                    <label for="descripcion">Fecha de vencimiento</label>
                    <input data-date-format="dd/mm/yyyy" name="fecha_vencimiento" required class="form-control" placeholder="Fecha de vencimiento del producto..." id="fecha_vencimiento" >
                </div>      
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group" >
                    <label >Dias de anticipacion de retiro de gondola
                    </label>
                    <div class="radios form-group">                                
                        <input type="radio" class="minimal"  id="dias_ant_retiro1" name="dias_ant_retiro" value="1" required>
                        <label for="dias_ant_retiro1"><span></span>1</label>
                        <input type="radio" class="minimal"  id="dias_ant_retiro2" name="dias_ant_retiro" value="2" >
                        <label for="dias_ant_retiro2"><span></span>2</label>
                        <input type="radio"  class="minimal"  id="dias_ant_retiro3" name="dias_ant_retiro" value="3" >
                        <label for="dias_ant_retiro3"><span></span>3</label>
                        <input type="radio" class="minimal"  id="dias_ant_retiro4" name="dias_ant_retiro" value="4" >
                        <label for="dias_ant_retiro4"><span></span>4</label>
                        <input type="radio" class="minimal"   id="dias_ant_retiro5" name="dias_ant_retiro" value="5" >
                        <label for="dias_ant_retiro5"><span></span>5</label>
                        <input type="radio" class="minimal"   id="dias_ant_retiro6" name="dias_ant_retiro" value="6" >
                        <label for="dias_ant_retiro6"><span></span>6</label>
                        <input type="radio"  class="minimal"  id="dias_ant_retiro7" name="dias_ant_retiro" value="7" >
                        <label for="dias_ant_retiro7"><span></span>7</label>
                        <input class="minimal" type="radio"  id="dias_ant_retiro8" name="dias_ant_retiro" value="8" >
                        <label for="dias_ant_retiro8"><span></span>8</label>
                    </div>
                </div>
            </div>
        </div>  

        <div  class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group" class="input-group date">
                    <label for="fecha_retiro_gondola">Fecha de retiro de gondola</label>

                 <!--   <input data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola" required class="form-control" placeholder="Fecha de retiro de gondola" id="fecha_retiro_gondola">-->
                    <div id="prueba"></div>
                </div>      
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 pull-left">
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" class="form-control">
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
<script type="text/javascript">
    //Reseteo el campo de dias de anticipacion de retiro de gondola si selecciona la fecha de vencimiento
    $("input[name=fecha_vencimiento]").click(function () {
        //vacio los check de los dias
        var ele = document.getElementsByName("dias_ant_retiro");
        for(var i=0;i<ele.length;i++)
            ele[i].checked = false;

        //Vacio el html del div de retiro de gondola
       document.getElementById("prueba").innerHTML="";
        
    });
</script>
<script type="text/javascript">
    //Calculo de fecha de retiro de gondola
    $("input[name=dias_ant_retiro]").click(function () {            
        //Obtengo el dia del radio y lo parseo a int
       cant_dia = $('input:radio[name=dias_ant_retiro]:checked').val()
        cant_dia=parseInt(cant_dia);
        //obtengo la fecha de vencimiento precargada con formato datepicker

        fecha_v= $('#fecha_vencimiento').datepicker({
            dateFormat: 'dd/mm/yyyy'}).datepicker("getDate");
        //Creo una nueva fecha con el mismo formato q vencimiento y sumo los dias
      /* if(fecha_v=="Invalid Date"){
            aux='';
            stilo='style="background-color: #FAECEC; border: 3px solid #CA0000"';
        }else{*/
            var fecha = new Date(fecha_v);
            fecha.setDate(fecha.getDate() + cant_dia);
            aux=(moment(fecha).format('DD/MM/YYYY'));
            stilo='style="background-color: #9aee6d; border: 3px solid #294729"';
       // }
            
        //alert(aux);
        
        document.getElementById("prueba").innerHTML="";
        var display_results = $("#prueba");
        results ='';
        results +='<input data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola" value='+aux+' required class="form-control" placeholder="'+aux+'" id="fecha_retiro_gondola" readonly class="form-group" '+stilo+'>';
        results += '</br>';
        display_results.append(results);
        //deshabilito el input
       // document.getElementById("fecha_retiro_gondola").disabled = true;
    });
</script>

<script type="text/javascript">
    //-datapicker de fechas
;(function($){
    $.fn.datepicker.dates['es'] = {
        days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene ", "Feb ", "Mar ", "Abr ", "May ", "Jun ", "Jul ", "Ago ", "Sep ", "Oct ", "Nov ", "Dic "],
        today: "Hoy",
        monthsTitle: "Meses",
        clear: "Borrar",
        weekStart: 1,
        format: "dd/mm/yyyy"
    };
}(jQuery));
$('#fecha_ingreso').datepicker({
                    format:'dd/mm/yyyy',  language: 'es',  autoclose: true, todayHighlight: true, 
    orientation: "top auto"
                }).datepicker("setDate",'now');
$("#fecha_vencimiento").datepicker( {language: 'es', autoclose: true, todayHighlight: true, 
    orientation: "top auto"});
</script>


<!--Para agregar la categoria por modal-->
<script type="text/javascript">
  function enviar_datos(){
    
    var token = '{{ csrf_token() }}';
      var cat = $("#cat-nombre").val();
            var descripcion = $("#cat-descripcion").val();
             var condicion = $('input:radio[name=condicion]:checked').val()
           //var condicion = $("#condicion").val(); 

   //console.log(cat,descripcion,condicion);
    
      $.ajax({
      type: "POST",
      url: '{{route("store_ajax_modal")}}',
      dataType: 'JSON',
      data:{"nombre":cat,"descripcion":descripcion,"condicion":condicion,"_token":token},
      success: function(data){
      // document.getElementById("tabla_resultados").innerHTML="";
         // var display_results = $("#contenedor");
          //display_results.reload();
  //    location.reload();
//      self.parent.location.reload();
//window.location="/administracion/prductos/creats";
window.location.reload(true);
    }
       });
  }
</script>
@show
