@extends('app')

@section('content')


<div class="center-block" style="text-align: center" >
                    <h1 class="cover-heading">PARKING ROUTE</h1>
                    <p class="lead">Encuentra un parqueadero!!!</p>
                    <p class="lead">{!! Html::image("img/parking.jpg","foto", array("class" => "img-rounded")) !!}</p>
                    {!! link_to('https://www.google.com.ec/',"Probar", array("class" => "btn btn-primary")) !!}
                </div>
            
        
@endsection
