<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/img/p.ico') }}" />
        <meta charset="utf-8">
        <title>PARQUEANDO</title>
        <meta name="description" content="This one page example has a fixed navbar and full page height sections. Each section is vertically centered on larger screens, and then stack responsively on smaller screens. Scrollspy is used to activate the current menu item. This layout also has a contact form example. Uses animate.css, FontAwesome, Google Fonts (Lato and Bitter) and Bootstrap." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="Codeply">



        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.1/animate.min.css" rel="stylesheet" />

        <link href="{{ asset('/portada/css/styles.css') }}" rel="stylesheet"/>
        <link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">

    </head>
    <body >
        <nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ asset('/index') }}"><img alt="Brand" src="{{ asset('/img/p.ico') }}" style="height: 40px; padding-top: 5px; float: left; padding-right: 5px"/></a>
                    <a class="navbar-brand text-sucess" href="{{ asset('/home') }}">PARQUEANDO</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-collapsible">
                    <ul class="nav navbar-nav navbar-left" id="menu">
                        <li><a id="inicio" href="#section1">Inicio</a></li>
                        <li><a href="#section2">Nuestro servicio</a></li>
                        <li><a href="#section10" >Tecnologías</a></li>
                        <li><a href="#section3" >App</a></li>
                        <li><a href="#section4">Contáctanos</a></li>
                        <li>&nbsp;</li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/auth/login') }}" style="font-size: 13px"><i class="glyphicon glyphicon-user"> </i> 
                                @if(isset($usuario))
                                {{ $usuario->name }}
                                @else
                                Iniciar sesión
                                @endif
                            </a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="container-fluid" id="section1">
            <div class="v-center">
                <h1 class="text-center">Parqueando</h1>
                <h2 class="text-center lato animate slideInDown">Ofrece tu servicio de estacionamiento aquí </h2>
                <p class="text-center">
                    <br>
                    @if(isset($usuario))
                    <a href="{{ url('/') }}" class="btn btn-info btn-lg btn-huge lato">INICIAR</a>
                    @else
                    <a href="{{ url('/auth/register') }}" class="btn btn-info btn-lg btn-huge lato">Registrarme</a>
                    @endif
                </p>
            </div>
            <a href="#section2">
                <div class="scroll-down bounceInDown animated">
                    <span>
                        <i class="fa fa-angle-down fa-2x"></i>
                    </span>
                </div>
            </a>
        </section>

        <section class="container-fluid" id="section2">
            <div class="container v-center">
                <div class="row">

                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="panel panel-default slideInRight animate">
                                    <div class="panel-heading" style="background-color: #A0D468; height: 100px">
                                        <h3>Administración del parqueadero</h3></div>
                                    <div class="panel-body">
                                        <hr>
                                        <p>Te ofrecemos un completo sistema web que te ayudará en la administración de uno o varios parqueaderos, tendrás control sobre cada plaza de estacionamiento.</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="panel panel-default slideInLeft animate">
                                    <div class="panel-heading" style="background-color: #FBB351; height: 100px">
                                        <h3>Web Responsive</h3></div>
                                    <div class="panel-body">
                                        <hr>
                                        <p> El sistema tiene un diseño web adaptativo, así que podrás  utilizar las herramientas desde cualquier dispositivo que cuente con un navegador web y acceso a internet.</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="panel panel-default slideInUp animate">
                                    <div class="panel-heading" style="background-color: #ED5565; height: 100px">
                                        <h3>Para tu cliente</h3></div>
                                    <div class="panel-body">
                                        <hr>
                                        <p>Para el conductor de vehiculos, ponemos a disposición una plicación móvil-híbrida que ofrece la posibilidad de buscar tus parqueaderos en tiempo real.</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!--/row-->
                <div class="row">
                    <br>
                </div>
            </div>
            <!--/container-->
        </section>

        <section id="section10">
            <div class="container-fluid v-center">
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-2">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{ asset('/img/gmaps.png') }}">
                            <h5 style="color: #FFFFFF; background-color: #00A858; border-style: solid;padding: 10px;">Google Maps</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-0">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{ asset('img/phonegap.png') }}">
                            <h5 style="color: #FFFFFF; background-color: #FBB351; border-style: solid; padding: 10px;">PhoneGap</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-0">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{asset('img/jquery-logo.png')}}">
                            <h5 style="color: #FFFFFF; background-color: #1169AE; border-style: solid; padding: 10px;">jQuery</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-0">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{'img/laravel.jpg'}}">
                            <h5 style="color: #FFFFFF; background-color: #F3654E; border-style: solid; padding: 10px;">Laravel</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-2">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{asset('img/bootstrap.png')}}">
                            <h5 style="color: #FFFFFF; background-color: #553A7C; border-style: solid; padding: 10px;">Bootstrap</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-0">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{asset('img/html5.png')}}">
                            <h5 style="color: #FFFFFF; background-color: #F16529; border-style: solid; padding: 10px;">HTML5</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-0">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{asset('img/js.png')}}">
                            <h5 style="color: #FFFFFF; background-color: #D6BA32; border-style: solid; padding: 10px;">JavaScript</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-offset-0">
                        <div class="text-center">
                            <img style="width:100px;" class="img-responsive img-thumbnail" src="{{asset('img/ajax-logo.png')}}">
                            <h5 style="color: #FFFFFF; background-color: #0274BA; border-style: solid; padding: 10px;">AJAX</h5>
                            <h3 class="text-center"></h3>
                        </div>
                    </div>
                </div>

                <!--/row-->
            </div>
        </section>

        <section class="container-fluid" id="section3">
            <h1 class="text-center">¿Eres conductor de un vehículo y buscas estacionamiento?</h1>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 class="text-center lato slideInUp animate">Te invitamos a probar nuestra aplicaión móvil</h3>
                    <br>
                    <br>
                    <p class="text-center">
                        <img src="{{ asset('/img/android-logo.png') }}" class="img-responsive thumbnail center-block ">
                    </p>
                </div>
            </div>
        </section>

        <section id="section4">
            <div class="container v-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Contacta con nosotros</h1>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombres" required="">
                            </div>                        
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" placeholder="Email" required="">
                            </div>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" name="phone" placeholder="Teléfono" required="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-10">                                
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-10">
                                <button class="btn btn-default btn-lg pull-right">Enviar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <!--                        <address>
                                                    <strong>Some LLC</strong><br>
                                                    795 Folsom Ave, Suite 600<br>
                                                    Newport, RI 94107<br>
                                                    P: (123) 456-7890
                                                </address>-->
                        <address>
                            <strong>Email</strong><br>
                            <a href="mailto:#">dmperez@utn.edu.ec</a>
                        </address>
                    </div>
                </div>
            </div>
        </section>


        <footer id="footer">
            <div class="container">

                <p class="text-right">2015</p>
            </div>
        </footer>

        <div class="scroll-up">
            <a href="#"><i class="fa fa-angle-up"></i></a>
        </div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="text-center"><img src="{{ asset('/img/user.png') }}" class="img-circle"><br></h2>
                    </div>
                    <div class="modal-body row">
                        <h6 class="text-center">COMPLETA ESTOS CAMPOS PARA INICIAR SESIÓN</h6>
                        <form class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0">
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="e-mail">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" placeholder="contraseña">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btn-lg btn-block">Iniciar Sesión</button>
                                <span class="pull-right"><a href="#">Registrarse</a></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <h6 class="text-center"><a href="">---???---</a></h6>
                    </div>
                </div>
            </div>
        </div>
        <!--scripts loaded here-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script src="{{ asset('/portada/js/scripts.js') }}"></script>
    </body>
</html>