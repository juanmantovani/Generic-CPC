@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<script src="{{ asset ("/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>

@section('main-content')
	<div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Nuevo Producto</h3>
                @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>  

            <!--CategoriaController, si el metodo es POST llama a la funcion store, si el metodo es path va a llamar a la funcion update, si el metodo es  delete llama a la funcion destroy-->
            {!!Form::open(array('action'=>'ProductoController@store','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}<!-- 13-36 3:13 se habilita files para que permita enviar archivos-->
            {{Form::token()}}
            <div class="row">
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
                            @foreach ($categorias as $cat)
                                <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                            @endforeach
                        </select>
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
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del producto...">
                    </div>      
                    
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del producto...">
                    </div>      
                    
                </div>



                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="descripcion">Fecha de ingreso</label>
                        <input data-date-format="dd/mm/yyyy" name="fecha_ingreso"  class="form-control" placeholder="Fecha de ingreso del producto..." id="fecha_ingreso">
                    </div>      
                </div>


                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group" class="input-group date">
                        <label for="descripcion">Fecha de vencimiento</label>
                        <input data-date-format="dd/mm/yyyy" name="fecha_vencimiento" class="form-control" placeholder="Fecha de vencimiento del producto..." id="fecha_vencimiento" >
                    </div>      
                </div>


                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                    </div>      
                    
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>
                </div>
            </div>
            
            
            {!!Form::close()!!}
    

        </div>
    
@endsection
@section('scripts')
<script type="text/javascript">
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
/* $('#fecha_ingreso').datepicker({ autoclose: true, language: 'es' });
$('#fecha_ingreso').datepicker('update', new Date());*/
$("#fecha_vencimiento").datepicker( {language: 'es', autoclose: true, todayHighlight: true, 
    orientation: "top auto"});
  
</script>
@show