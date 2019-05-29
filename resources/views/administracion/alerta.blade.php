@if(session('status'))
			<div class="col-md-9 col-md-offset-1">
				<div class="box box-{{ session('tipo') }} success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ session('titulo') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        {{ session('status') }}
                    </div>
                </div>
			</div>
@endif