@extends('app')

@section('content')


<div class="center-block" style="text-align: center" >
    <h1 class="cover-heading">PARQUEANDO</h1>
    <p class="lead">Encuentra un parqueadero!!!</p>
    <p class="lead">{!! Html::image("img/parking.jpg","foto", array("class" => "img-rounded")) !!}</p>
    {!! Form::open(array('method' => 'GET', 'route' => array('error.show', '$id'=>'403'))) !!}
    {!! Form::submit('PROBAR', array('class' => 'btn btn-info')) !!}
    {!! Form::close() !!}
</div>


@endsection
