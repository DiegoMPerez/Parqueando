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

<div class="center-block" style="text-align: center" >
    <h1 class="cover-heading">PARQUEANDO</h1>
    <p class="lead">Encuentra un parqueadero!!!</p>
    <p class="lead">{!! Html::image("img/parking.jpg","foto", array("class" => "img-rounded")) !!}</p>
    {!! link_to('error403',"INSTALAR APP", array("class" => "btn btn-primary")) !!}
    @if(!$parqueadero)
    {!! link_to('parqueaderos/create',"OFRECER EL SERVICIO DE PARQUEADERO", array("class" => "btn btn-info")) !!}
    @else
    {!! link_to('parqueaderos',"MIS PARQUEADEROS", array("class" => "btn btn-info")) !!}
    @endif
</div>

@endsection
