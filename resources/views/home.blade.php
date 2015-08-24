@extends('app')
@section('title')
PARQUEANDO
@stop
@section('content')


<div class="center-block" style="text-align: center" >
    <h1 class="cover-heading">PARQUEANDO</h1>
    <p class="lead">Encuentra un parqueadero!!!</p>
    <p class="lead">{!! Html::image("img/parking.jpg","foto", array("class" => "img-rounded")) !!}</p>
    {!! link_to('error403',"INSTALAR APP", array("class" => "btn btn-primary")) !!}
    {!! link_to('parqueaderos/create',"OFRECER EL SERVICIO DE PARQUEADERO", array("class" => "btn btn-info")) !!}
</div>


@endsection
