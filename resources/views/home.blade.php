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

<div style="text-align: center; padding-top: 100px; color: #fff; font-family: sans-serif; width: 100%" >
    <h1 class="cover-heading" style="font-size: 50px; ">PARQUEANDO</h1>
    <p class="lead">Encuentra un parqueadero!!!</p>
    {!! link_to('error403',"INSTALAR APP", array("class" => "btn btn-primary")) !!}
    @if(!$parqueadero)
    {!! link_to('parqueaderos/create',"OFRECER EL SERVICIO DE PARQUEADERO", array("class" => "btn btn-info")) !!}
    @else
    {!! link_to('parqueaderos',"MIS PARQUEADEROS", array("class" => "btn btn-info")) !!}
    @endif
</div>

<style>
    body{
        background: no-repeat center fixed url("{{ asset('img/parqueando.jpg') }}");
        -webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
        
    }
</style>
@endsection
