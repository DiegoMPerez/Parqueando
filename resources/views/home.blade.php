@extends('app')
@section('title')
PARQUEANDO
@stop
@section('menu')
@if($parqueadero)
<ul class="nav navbar-nav">
    <li>
        <button type="button" class="btn btn-default navbar-btn">Entrar</button>
    </li>    
</ul>
@endif
@endsection
@section('content')
<div class="panel-body" id="panel">
    <div class="panel-body" style="text-align: center; color: #fff">
        <h1 class="text-center" style="color: #777777">Bienvenido a <strong style="color: #337AB7" id="parqueando">PARQUEANDO</strong></h1>
        <p class="lead" style="color: #777777" ><a id="buscar">¡Encuentra un parqueadero!</a></p>
        <div class="r   ow">
            <div class="col-xs-12 col-sm-12 col-md-12">
                {!! link_to('error403',"INSTALAR APP", array("class" => "btn btn-primary")) !!}
                @if(!$parqueadero)
                {!! link_to('parqueaderos/create',"OFRECER EL SERVICIO DE PARQUEADERO", array("class" => "btn btn-info")) !!}
                @else
                {!! link_to('parqueaderos',"MIS PARQUEADEROS", array("class" => "btn btn-info")) !!}
                @endif
            </div>

        </div>


    </div>

</div>
<style>
    body{
        //background:  no-repeat center fixed rgba(69,175,220,0.1);
        background: no-repeat center fixed url("{{ asset('img/parqueando.jpg') }}");
        //background: no-repeat center fixed url("{{ asset('img/grid.png') }}");

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }
    .content{
        background:  no-repeat center fixed rgba(255,255,255,0.8);
        //background: no-repeat center fixed url("{{ asset('img/parqueando.jpg') }}");
        //background: no-repeat center fixed url("{{ asset('img/grid.png') }}");

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        margin: 10%;



    }
    #panel{
        font-family:  Times, "Times New Roman", Georgia, serif;
    }

    .text-center{
        font-size: 40px;
        font-family: sans-serif;
        text-align: center;
    }

    #parqueando{
        font-size: 28px;
    }

    #buscar:hover{
        color: #337AB7;
    }

    @media only screen and (min-width: 700px) {

        .text-center{
            font-size: 68px;
        }
        #parqueando{
            font-size: 68px;
        }
    }





</style>
@endsection

