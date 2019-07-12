<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema web de administracion de vencimiento de productos ">
    <meta name="author" content="Sacks Damian">

    <title>Sistema web de administracion de vencimiento de productos</title>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/all-landing.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

</head>

<body data-spy="scroll" data-target="#navigation" data-offset="50">

<div id="app" v-cloak>
    <!-- Fixed navbar -->
    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>Sistema web de vencimiento de productos</b></a>
            </div>
            
        </div>
    </div>


    <div id="Inicio" name="Inicio">
        <div id="headerwrap">
            <div class="container">
                <div class="row centered">
                    @if (Auth::guest())

                    @include('adminlte::auth.login')
                        <a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a>
                        <a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a>
                    @else
                        <li><a href="/administracion">{{ Auth::user()->name }}</a></li>
                    @endif
                </div>
            </div> <!--/ .container -->
        </div><!--/ #headerwrap -->
    </div>

  
    <footer>
        <div id="c">
            <div class="container">
                <p>
                   

            </div>
        </div>
    </footer>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ url (mix('/js/app-landing.js')) }}"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
