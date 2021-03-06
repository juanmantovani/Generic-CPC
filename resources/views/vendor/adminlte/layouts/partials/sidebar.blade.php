
<aside class="main-sidebar">
    <section class="sidebar">
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    
                    <img src="{{ asset('/img/perfil.png') }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                   
                </div>
            </div>
        @endif
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menú</li>
            <li class=""><a href="{{ url('/administracion') }}"><i class='fa fa-home custom'></i> <span>Inicio</span></a></li>
            <!--Productos-->
            <li class="treeview">
                <a href="#"><i class='fa fa-archive'></i> <span> Almacén </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">  
                    <li><a href="/administracion/productos"><i class='fa fa-product-hunt'></i><span> Productos</span></a></li>
                    <li><a href="/administracion/categorias"><i class='fa fa-navicon'></i><span> Categorías</span></a></li>
                </ul>
            </li>
            <!--Clientes-->
            <li class=""><a href="{{ url('/administracion/clientes') }}"><i class='fa fa-users'></i> <span>Clientes</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
