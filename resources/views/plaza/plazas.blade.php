@extends('app')
@section('title')
plazas de estacionamiento
@stop

@section('linktop')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('simplegrid.css') }}"/>

@endsection

@section('content')
<div class="grid" style="margin-bottom: 60px; margin-top: -40px"> 
    <div class="grid grid-pad" style="text-align: center">

        @for ($i=1; $i<=30 ; $i++  )

        @if(($i%2)==1)
        <div id="d" class="col-1-5" >
            <div id="{{ $i }}" class="btn-success" style="height: 100px;" data-id="{{ $i }}">
                <h3></h3>
                {!! Html::image("imagenes/general.png","foto", array("class" => "img-rounded")) !!}
                <h3 ><p "><strong>PLAZA {{ $i }}</strong></p></h3>
                
            </div>
        </div>

        @else
        <div id="d" class="col-1-5" >
            <div id="{{ $i }}" class="btn-success" style="height: 100px" data-id="{{ $i }}">
                <h3></h3>
                {!! Html::image("imagenes/general.png","foto", array("class" => "img-rounded")) !!}
                <h3 ><p "><strong>PLAZA {{ $i }}</strong></p></h3>
                
            </div>
        </div>

        @endif
        @endfor
    </div>
</div>

<script>

$('.col-1-5').click('enter', function () {
    console.log($(this).children('div').attr("class"));
    if ($(this).children('div').attr("class") === "btn-info") {
        $(this).children('div').attr("class", "btn-success");
    } else {
        $(this).children('div').attr("class", "btn-info");
    }
    console.log($(this).children('div').data('id'));
});


</script>
@endsection

