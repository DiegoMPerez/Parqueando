@extends('app')
@section('title')
plazas de estacionamiento
@stop

@section('linktop')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('simplegrid.css') }}"/>

@endsection

@section('content')

<div class="grid" style="margin-bottom: 60px; margin-top: -40px; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
     unselectable="on"
     onselectstart="return false;" 
     onmousedown="return false;">

    <div class="grid grid-pad" style="text-align: center">

        @for ($i=1; $i<=30 ; $i++  )

        @if(($i%2)==1)
        <div id="d" class="col-1-5" >
            <div id="{{ $i }}" class="btn-success" style="height: 100px;" data-id="{{ $i }}">
                <h3></h3>
                {!! Html::image("imagenes/general.png","foto", array("class" => "img-rounded", "style" => "pointer-events:none")) !!}
                <h3 ><p><strong>PLAZA {{ $i }}</strong></p></h3>

            </div>
        </div>

        @else
        <div id="d" class="col-1-5" >
            <div id="{{ $i }}" class="btn-success" style="height: 100px" data-id="{{ $i }}">
                <h3></h3>
                {!! Html::image("imagenes/general.png","foto", array("class" => "img-rounded", "style" => "pointer-events:none")) !!}
                <h3 ><p><strong>PLAZA {{ $i }}</strong></p></h3>

            </div>
        </div>

        @endif
        @endfor
    </div>
</div>

<script>
    (function ($) {
        $.fn.disableSelection = function () {
            return this
                    .attr('unselectable', 'on')
                    .css('user-select', 'none')
                    .on('selectstart', false);
        };
    })(jQuery);
    var isTouchDevice = 'ontouchstart' in document.documentElement;

    var timeout, timeout2;
    console.log(isTouchDevice);
    $('.col-1-5').on("mousedown", function () {

        var id = $(this).children('div').attr("class");
        var div = $(this).children('div');

        timeout = setInterval(function () {
            console.log(id);

            if (id === "btn-info" || id === "btn-warning") {
                div.attr("class", "btn-success");
            } else {
                div.attr("class", "btn-info");
            }
            console.log(div.data('id'));

        }, 500);


        timeout2 = setInterval(function () {
            clearInterval(timeout);
            console.log(id);


            div.attr("class", "btn-warning");

            console.log(div.data('id'));

        }, 2000);

        console.log($(this).children('div').data('id'));
        return false;
    });

    $('.col-1-5').on('mouseup touchend', function () {

        clearInterval(timeout);
        clearInterval(timeout2);
        return false;
    });

</script>
@endsection

