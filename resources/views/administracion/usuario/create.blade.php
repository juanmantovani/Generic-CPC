
  @extends('adminlte::page')

@section('htmlheader_title')
  Change Title here!
@endsection

@section('contentheader_title', 'Creacion de nuevo producto')


@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3>Nueva Usuario</h3>
       
         {!! Form::open([
                'action' => ['UsersController@store'],
                'files' => true
            ])
        !!}

        <div class="box-body" style="margin:10px;">
          @include('admin.users.form')
        </div>

        <div class="box-footer" style="background-color:#f5f5f5;border-top:1px solid #d2d6de;">
          <button type="submit" class="btn btn-info" style="width:100px;">Save</button>
          <a class="btn btn-warning " href="{{ route(ADMIN.'.users.index') }}" style="width:100px;"><i class="fa fa-btn fa-back"></i>Cancel</a>
        </div>

      {!! Form::close() !!}

        <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
        {!!Form::close()!!}
      </div>  
    </div>

  </div>
@endsection