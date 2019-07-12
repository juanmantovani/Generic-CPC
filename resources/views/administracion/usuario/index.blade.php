
  @extends('adminlte::page')

@section('htmlheader_title')
  Change Title here!
@endsection

@section('contentheader_title', 'Creacion de nuevo producto')


@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      div class="box-body table-responsive no-padding">
          <table id="tbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class='bool text-center'>Active</th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="actions"></th>
                    </tr>
                </tfoot>

                <tbody>
                  @foreach ($items as $item)

                      <tr>
                          <td><a href="{{ route(ADMIN . '.users.edit', $item->id) }}">{{ $item->name }}</a></td>
                          <td>{{ $item->email }}</td>
                          <td>{{ Helper::getRolename($item->role)  }}</td>
                          <td>{{ $item->active }}</td>
                          <td class="actions">
                            @if ( Auth::user()->rolename() === "Superadmin" || Auth::user()->role > $item->role)
                              <ul class="list-inline" style="margin-bottom:0px;">
                                  <li><a href="{{ route(ADMIN . '.users.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></li>
                                  <li>
                                      {!! Form::open([
                                          'class'=>'delete',
                                          'url'  => route(ADMIN . '.users.destroy', $item->id),
                                          'method' => 'DELETE',
                                          ])
                                      !!}

                                      <button class="btn btn-danger btn-xs" title="{{ trans('app.delete_title') }}"><i class="fa fa-trash"></i></button>

                                      {!! Form::close() !!}
                                  </li>
                              </ul>
                            @elseif (Auth::user()->id === $item->id)
                            <ul class="list-inline" style="margin-bottom:0px;">
                              <li>
                                <a href="{{ url('admin\profileedit', auth()->id()) }}" title="Update Profile" class="btn btn-primary btn-xs"><i class="fa fa-user"></i></a></li>
                              </li>
                            </ul>
                            @else

                                <i class="fa fa-ban" title="Forbidden" style="color:red;">

                            @endif
                          </td>
                      </tr>

                  @endforeach
                  </tbody>


            </table>
        </div>
      </div>  
    </div>

  </div>
@endsection

@section('js')
  <script>
    (function($) {
      var table = $('.data-tables').DataTable({
        "columnDefs": [{
           "targets": 'no-sort',
           "orderable": false,
         }],
      });
      //replace bool column to checkbox
      renderBoolColumn('#tbl','bool');
    })(jQuery);
  </script>
@stop