<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/administracion') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li>
            <!--Productos-->
            <li class="treeview">
                <a href="#"><i class='fa fa-archive'></i> <span> Almacen </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">  
                    <li><a href="/administracion/productos"><i class='fa fa-product-hunt'></i><span> Productos</span></a></li>
                    <li><a href="/administracion/categorias"><i class='fa fa-navicon'></i><span> Categorias</span></a></li>
                </ul>
            </li>
           <!--Reportes-->
            <li class="treeview">
                <a href="#"><i class='fa fa-newspaper-o'></i> <span> Reportes </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">  
                    <li><a href="/administracion/reportes"><i class='fa fa-warning'></i><span>Reportes por vencimiento </span></a></li>
                    <li><a href="/administracion"><i class='fa fa-navicon'></i><span> Categorias</span></a></li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
