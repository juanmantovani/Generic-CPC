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
                   
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">asdasd</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/administracion') }}"><i class='fa fa-home custom'></i> <span>Inicio</span></a></li>
           
            <!--Productos-->
            <li class="treeview">
                <a href="#"><i class='fa fa-archive'></i> <span> Almacén </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">  
                    <li><a href="/administracion/productos"><i class='fa fa-product-hunt'></i><span> Productos</span></a></li>
                    <li><a href="/administracion/categorias"><i class='fa fa-navicon'></i><span> Categorías</span></a></li>
                </ul>
            </li>
           <!--Reportes-->
            <li class="treeview">
                <a href="#"><i class='fa fa-newspaper-o'></i> <span> Reportes </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">  
                    <li><a href="/administracion/reportes"><i class='fa fa-warning'></i><span>Reportes por vencimiento </span></a></li>
                  
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
