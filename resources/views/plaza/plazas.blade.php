@extends('app')
@section('title')
plazas de estacionamiento
@stop

@section('linktop')


<link rel="stylesheet" type="text/css" href="{{ asset('simplegrid.css') }}"/>

@endsection

@section('content')

<div class="grid" style="margin-bottom: 60px; margin-top: -40px; -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" 
     unselectable="on"
     onselectstart="return false;" 
     onmousedown="return false;">

    <div class="grid grid-pad" style="text-align: center">
        @if(isset($plazas))
        <h1>{!! $plazas->parqueadero !!}</h1>
        @foreach($plazas as $plaza)
        {!! Form::Model($plaza, array('method' => 'POST','id'=>'form', 'route' => array('plazas', $plaza->id_parqueadero, $plaza->numero),'class' => 'form-horizontal', 'files' => true)) !!}

        <div id="d" class="col-1-5" >
            <div id="{{ $plaza->numero }}" class="{{ $plaza->clase, 'form-group' }}" style="height: 100px" data-parqueadero='{{ $plaza->id_parqueadero }}'  data-numero="{{ $plaza->numero }}">
                <input class="form-group" type="text" hidden="true" value="{{ $plaza->value }}" name="estado_plaza" >
                <h3></h3>
                {!! Html::image("imagenes/general.png","foto", array("class" => "img-rounded", "style" => "pointer-events:none")) !!}
                <h3 ><p><strong>PLAZA {{ $plaza->numero }}</strong></p></h3>
            </div>
        </div>

        {!! Form::close() !!}
        @endforeach
        @endif
    </div>
</div>

<script>

    var timeout, timeout2;

    $('.col-1-5').on("mousedown", function (event) {
        var divp = $(this);
        var id = $(this).children('div').attr('class');
        var div = $(this).children('div');
        var estado_plaza = $(this).children('input');
        console.log(estado_plaza);
        var form;
        var parqueadero = div.data('parqueadero');
        var numero_plaza = div.data('numero');

        timeout = setInterval(function (e) {
            console.log(id);

            if (id === "btn-info" || id === "btn-warning") {
                div.attr("class", "btn-success");
                $('input[name=estado_plaza]').val("0");
                form = divp.parent('form');

            } else {
                div.attr("class", "btn-info");
                $('input[name=estado_plaza]').val("1");
                form = divp.parent('form');

            }
            console.log(parqueadero, numero_plaza);
            event.preventDefault();
            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                method: 'PUT',
                success: function (data) {
                }
            });
        }, 500);

        timeout2 = setInterval(function () {
            clearInterval(timeout);

            div.attr("class", "btn-warning");
            $('input[name=estado_plaza]').val("2");
            form = divp.parent('form');
            event.preventDefault();
            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                method: 'PUT',
                success: function (data) {
                }
            });
        }, 2000);

    });

    $('.col-1-5').on('mouseup touchend', function () {

        clearInterval(timeout);
        clearInterval(timeout2);
        return false;
    });

</script>
@endsection

