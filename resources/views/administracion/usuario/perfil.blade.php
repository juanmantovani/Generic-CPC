
  @extends('adminlte::page')

@section('htmlheader_title')
  Perfil del usuario
@endsection

@section('contentheader_title', 'Creacion de nuevo producto')


@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3>Edición de perfil del usuario</h3>
       
               {!! Form::model($usuario, [
                'action' => ['UserController@update2', $usuario->id],
                'method' => 'put',
                'files' => false
            ])
        !!}

        <div class="box-body" style="margin:10px;">
    

  			<div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre.."
                                       value="@if(isset($usuario->name)){{ $usuario->name }}@endif" required>
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email..."
                                       value="@if(isset($usuario->email)){{ $usuario->email }}@endif" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Dejar vacio para mantener el mismo">
    
                               
                            </div>
            
        </div>

        <div >
      	  <button type="submit" class="btn btn-info" style="width:100px;">Guardar</button>
      	</div>

      {!! Form::close() !!}
      </div>  
    </div>

  </div>
@endsection



                          

                            
                            
                        

