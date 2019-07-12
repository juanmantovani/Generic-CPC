<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/administracion') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Admin</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Administración</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->


                <!-- Notifications Menu -->
               
                <!-- Tasks Menu -->
                
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu" id="user_menu" style="max-width: 280px;white-space: nowrap;">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 280px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis">
                            <!-- The user image in the navbar
                            <img src="{ { Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('/img/perfil.png') }}" class="img-circle" alt="User Image" />
                                <p>
                                    <span data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                                  
                                </p>
                            </li>
                            <!-- Menu Body -->
                           
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ action('UserController@perfil',Auth::user()->id) }}" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
               
            </ul>
        </div>
    </nav>
</header>
