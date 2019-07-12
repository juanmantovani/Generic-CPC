@extends('adminlte::page')

@section('htmlheader_title')
	Editando producto
@endsection



<meta name="csrf-token" content="{{ csrf_token() }}">


<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>


<!--Para formatear la fecha
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
-->

<script src="{{ asset ("js/moment/v2.14.1/moment.min.js") }}" type="text/javascript"></script>


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


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			
            <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Producto: {{$producto->nombre}}</h3>
            
        </div><!--columna-->
    </div><!--fila-->
           
            {!!Form::model($producto,['method'=>'PATCH','action'=>['ProductoController@update',$producto->id],'files'=>'true'])!!}

            {{Form::token()}}
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{$producto->nombre}}" class="form-control" placeholder="{{$producto->nombre}}">
                    </div>  
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Categoría</label>
                        <select name="idcategoria" class="form-control" required>
                            @foreach ($categorias as $unacategoria)
                                @if ($unacategoria->id==$producto->categoria_id)
                                <option value="{{$unacategoria->id}}" selected>{{$unacategoria->nombre}}</option><
                                @else
                                <option value="{{$unacategoria->id}}">{{$unacategoria->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>      
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" name="codigo" required value="{{$producto->codigo}}" class="form-control" placeholder="{{$producto->codigo}}" required>
                    </div>                      
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" required value="{{$producto->stock}}" class="form-control" placeholder="{{$producto->stock}}" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" value="{{$producto->descripcion}}" class="form-control" placeholder="Descripción del artículo...">
                    </div>      
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de ingreso</label>
                        <input data-date-format="dd/mm/yyyy" name="fecha_ingreso" id="fecha_ingreso" value="{{ Carbon\Carbon::parse($producto->fecha_ingreso)->format('d/m/Y') }}" class="form-control" placeholder="Fecha de ingreso del producto..." required>
                    </div>      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="fecha_vencimiento">Fecha de vencimiento</label>
                        <input data-date-format="dd/mm/yyyy" name="fecha_vencimiento" id="fecha_vencimiento" value="{{ Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d/m/Y') }}" class="form-control" placeholder="Fecha de vencimiento del producto..." required>
                    </div>      
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="descripcion">Dias de anticipacion de retiro de gondola</label>
                        <div class="radios form-group">                                
                            <input type="radio" class="minimal"  id="dias_ant_retiro1" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==1) "1" checked @else 1  @endif  required>
                            <label for="dias_ant_retiro1"><span></span>1</label>
                            <input type="radio" class="minimal"  id="dias_ant_retiro2" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==2) "2" checked @else 2 @endif>
                            <label for="dias_ant_retiro2"><span></span>2</label>
                            <input type="radio"  class="minimal"  id="dias_ant_retiro3" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==3) "3" checked @else 3 @endif >
                            <label for="dias_ant_retiro3"><span></span>3</label>
                            <input type="radio" class="minimal"  id="dias_ant_retiro4" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==4) "4" checked @else 4 @endif>
                            <label for="dias_ant_retiro4"><span></span>4</label>
                            <input type="radio" class="minimal"   id="dias_ant_retiro5" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==5) "5" checked @else 5 @endif >
                            <label for="dias_ant_retiro5"><span></span>5</label>
                            <input type="radio" class="minimal"   id="dias_ant_retiro6" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==6) "6" checked @else 6 @endif>
                            <label for="dias_ant_retiro6"><span></span>6</label>
                            <input type="radio"  class="minimal"  id="dias_ant_retiro7" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==7) "7" checked @else 7 @endif>
                            <label for="dias_ant_retiro7"><span></span>7</label>
                            <input class="minimal" type="radio"  id="dias_ant_retiro8" name="dias_ant_retiro" value=@if (isset($producto->dias_ant_retiro) &&  $producto->dias_ant_retiro==8) "8" checked @else 8 @endif>
                            <label for="dias_ant_retiro8"><span></span>8</label>
                        </div>
                    </div>      
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="fecha_retiro_gondola">Fecha de retiro de gondola</label>
                    <div class="form-group" id="prueba">
                        <input data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola" value="{{ Carbon\Carbon::parse($producto->fecha_retiro_gondola)->format('d/m/Y') }}" required class="form-control" placeholder="'+aux+'" id="fecha_retiro_gondola" class="form-group" readonly >
                        <!--<label for="fecha_retiro_gondola">Fecha de retiro de gondola</label>
                        <input data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola" id="fecha_retiro_gondola" value="{ { Carbon\Carbon::parse($producto->fecha_retiro_gondola)->format('d/m/Y') }}" class="form-control" placeholder="Fecha de ingreso del producto..." required readonly> -->
                    </div>      
                </div>
                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                        @if ( ($producto->imagen)!="")
                            <img src="{{ asset('imagenes/productos/'.$producto->imagen) }} " height="120px">
                        @endif
                    </div> 
                </div>
            </div>

            <div class="form-group">
                <label for="estado">Condicion</label><br>
                    <input type="radio" name="estado"  id="estado1" value="1"  {{ (isset($producto->estado) && $producto->estado == 1 ) ? 'checked="checked"' : '' }}><label for="estado1">Activo</label>
                <br>
                    <input type="radio" name="estado"  id="estado0" value="0" {{ (isset($producto->estado) && $producto->estado == 0 ) ? 'checked="checked"' : '' }}><label for="estado0">Inactivo</label>

                </div>

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

@endsection

@section('scripts')
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
                });
$("#fecha_vencimiento").datepicker( {language: 'es', autoclose: true, todayHighlight: true, 
    orientation: "top auto"});
</script>

<script type="text/javascript">
    $("input[name=dias_ant_retiro]").click(function () {            
        //Obtengo el dia del radio y lo parseo a int
       cant_dia = $('input:radio[name=dias_ant_retiro]:checked').val()
        cant_dia=parseInt(cant_dia);
        //obtengo la fecha de vencimiento precargada con formato datepicker

        fecha_v= $('#fecha_vencimiento').datepicker({
            dateFormat: 'dd/mm/yyyy'}).datepicker("getDate");
            var fecha = new Date(fecha_v);
            fecha.setDate(fecha.getDate() + cant_dia);
            aux=(moment(fecha).format('DD/MM/YYYY'));
            stilo='style="background-color: #9aee6d; border: 3px solid #294729"';

        
        document.getElementById("prueba").innerHTML="";
        var display_results = $("#prueba");
        results ='';
        results +='<input data-date-format="dd/mm/yyyy" name="fecha_retiro_gondola" value='+aux+' required class="form-control" placeholder="'+aux+'" id="fecha_retiro_gondola" class="form-group" readonly '+stilo+'>';
        results += '</br>';
        display_results.append(results);
    });

</script>
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
@show