
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@section('title')PARQUEANDO @show</title>
        @section('linktop')@show
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'/>
    </head>
    <body>
        <!--Prevenir el botón atras después de cerrar la sesión-->
        <?php
        echo
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">PARQUEANDO</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @if(isset($parqueadero))
                        <li><a href="{{ url('parqueaderos') }}">Parqueaderos</a></li>
                        @endif
                        @if(Entrust::hasRole('admin'))
                        <li><a href="{{ url('tipovehiculos') }}">Tipo de Vehículos</a></li>
                        @endif
                        @if(Entrust::hasRole('admin'))
                        <li><a href="{{URL::to('usuarios')}}">Usuarios</a></li>
                        @endif

                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Iniciar sesión</a></li>
                        <li><a href="{{ url('/auth/register') }}">Registrarse</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Salir</a></li>
                            </ul>
                        </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            @yield('content')
        </div>
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        @yield('linkbot')
        <div class="footer">
            <p style="margin-right: 25px; margin-top: 5px; font-family: monospace; text-align: right"> v. 0.7.5 </p>
        </div>
    </body>
</html>
