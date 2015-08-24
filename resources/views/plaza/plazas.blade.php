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

        @foreach($plazas as $plaza)
        <form action="{!! '/parqueadero/'.$plazas->parqueadero.'/plaza/'.$plaza->numero !!} " method="PUT">
            <div id="d" class="col-1-5" >
                <div id="{{ $plaza->numero }}" class="btn-success" style="height: 100px" data-id="{{ $plaza->numero }}">
                    <h3></h3>
                    {!! Html::image("imagenes/general.png","foto", array("class" => "img-rounded", "style" => "pointer-events:none")) !!}
                    <h3 ><p><strong>PLAZA {{ $plaza->numero }}</strong></p></h3>
                </div>
            </div>
        </form>
        @endforeach
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
        var form = $(this).parent('form');

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

        $('#form').submit(function (event) {

            event.preventDefault();
            var url = "{{URL::route('parqueaderos.store')}}";
            var form = $('#form');
            var data = form.serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).closest('form').serialize(),
                success: function (data) {
                    // Success...
                    console.log(data);

                    location.href = "{{URL('parqueaderos/success')}}";
                },
                error: function (jqXhr) {
                    if (jqXhr.status === 401) //redirect if not authenticated user.
                        $(location).prop('pathname', 'auth/login');
                    if (jqXhr.status === 422) {
                        //process validation errors here.
                        var errors = jqXhr.responseJSON; //this will get the errors response data.
                        //show them somewhere in the markup
                        //e.g
                        errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function (key, value) {
                            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';
                        $('#form-errors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                        $('html, body').animate({scrollTop: 0}, 'fast');
                    }
                    if (jqXhr.status === 403) {
                        location.href = "{{URL('error403')}}";
                    }
                    if (jqXhr.status === 500) {
                        location.href = "{{URL('error500')}}";
                    } else {

                    }
                }
            });
        });

    });

    $('.col-1-5').on('mouseup touchend', function () {

        clearInterval(timeout);
        clearInterval(timeout2);
        return false;
    });

</script>
@endsection

