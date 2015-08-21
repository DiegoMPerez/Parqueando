@extends('app')
@section('title')
Nuevo Parqueadero
@stop
@section('linktop')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
@endsection

@section('content')
<div class="container-fluid" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear un parqueadero</div>
                <div class="panel-body">

                    <!--                    @if (count($errors) > 0)
                                        <div class="alert alert-danger text-center" >
                                            <strong>Error</strong> :P <br><br>
                                        </div>
                                        @endif-->
                    @if($errors->has())
                    <div class='alert alert-danger'>
                        @foreach ($errors->all('<p>:message</p>') as $message)
                        {!! $message !!}
                        @endforeach
                    </div>
                    @endif
                    <div id="form-errors" ></div>
                    {!! Form::open(['route' => 'parqueaderos.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'form' ]) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre del Parqueadero:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nombre', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div>    
                    <!--Teléfono                    -->
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono de contacto:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('telefono', '', ['class' => 'form-control', 'maxlength' => '10']) !!}
                        </div>
                    </div>
                    <!--Número de plazas-->
                    <div class="form-group">
                        {!! Form::label('numero', 'Número de plazas:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::number('numero', '', ['class' => 'form-control', 'min' => '0', 'max' => '999']) !!}
                        </div>
                    </div> 
                    <!--Ubicación geográfica-->

                    <div class="form-group">
                        {!! Form::label('ubicacion', 'Ubicación del Parqueadero', ['class' => 'col-md-4 control-label']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('buscar', 'Buscar lugar:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('buscar', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('latitud', 'Latitud:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('lat', '', ['class' => 'form-control', 'id' => 'lat', 'readonly']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('longitud', 'Longitud:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('lng', '', ['class' => 'form-control', 'id' => 'lng', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div id="map-canvas" style="height: 200px "></div>
                        </div>
                    </div>

                    <!-- DIRECCIÓN --> 
                    <div class="form-group">
                        {!! Form::label('pais', 'País:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('pais', '', ['class' => 'form-control', 'id' => 'pais', 'readonly']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('ciudad', 'Ciudad:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('ciudad', '', ['class' => 'form-control', 'id' => 'ciudad', 'readonly']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('direccion', 'Dirección:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('direccion', '', ['class' => 'form-control', 'id' => 'direccion']) !!}
                        </div>
                    </div>


                    <!--                    <div class="panel panel-default">
                                            Horario de atención
                                            <div class="form-group">
                                                {!! Form::label('horario', 'Horario de atención', ['class' => 'col-md-4 control-label']) !!}
                                                <div class="col-md-6 col-md-offset-4">
                                                    <label>
                                                        {!! Form::checkbox('estado', 'estado',true) !!}
                                                        &nbsp; 24 horas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('personalizado', 'Horario Personalizado', ['class' => 'col-md-4 control-label']) !!}
                                                <div class="col-md-6">
                                                    <label>
                                                        Hora de apertura &nbsp; <input type="time" name="hinicio">
                                                        &nbsp; Hora de cierre &nbsp; <input type="time" name="hfin">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            Tarifas
                                            <div class="form-group">
                                                {!! Form::label('tarifa', 'Tarifas', ['class' => 'col-md-4 control-label']) !!}
                                            </div>
                                            Precio hora
                                            <div class="form-group">
                                                {!! Form::label('precioh', 'Cada hora:', ['class' => 'col-md-4 control-label']) !!}
                                                <div class="col-md-2">
                                                    {!! Form::number('tarifahora', '', ['class' => 'form-control', 'min' => '0', 'max' => '999']) !!}
                                                </div>
                                            </div> 
                                            Precio semanal
                                            <div class="form-group">
                                                {!! Form::label('tarifasemana', 'Semanal:', ['class' => 'col-md-4 control-label']) !!}
                                                <div class="col-md-2">
                                                    {!! Form::number('tarifasemana', '', ['class' => 'form-control', 'min' => '0', 'max' => '999']) !!}
                                                </div>
                                            </div> 
                                            Precio anual
                                            <div class="form-group">
                                                {!! Form::label('tarifaanual', 'Anual:', ['class' => 'col-md-4 control-label']) !!}
                                                <div class="col-md-2">
                                                    {!! Form::number('tarifaanual', '', ['class' => 'form-control', 'min' => '0', 'max' => '999']) !!}
                                                </div>
                                            </div> 
                                        </div>
                    -->                    

                    <!--Estado-->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="estado"> ¿El parqueadero esta activo?
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--botón enviar-->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="enviar">Crear</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('linkbot')
<script>

    $(document).ready(function () {

        // GEOLOCALIZACIÓN
        geolocalizacion();
        function geolocalizacion() {
            if (navigator.geolocation.getCurrentPosition(showPosition)) {
            } else {
                showPosition(null);
            }
        }
        var _lat = 0;
        var _lng = 0;
        function showPosition(position) {
            if (position === null) {
                _lat = 0.3212001155157536;
                _lng = -78.10052093275755;
            } else {
                _lat = position.coords.latitude;
                _lng = position.coords.longitude;
            }

            $('#lat').val(_lat);
            $('#lng').val(_lng);
            var geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat: _lat, lng: _lng},
                zoom: 15
            });
            var searchBox = new google.maps.places.SearchBox(document.getElementById('buscar'));

            var marker = new google.maps.Marker({
                position: {
                    lat: _lat,
                    lng: _lng
                },
                map: map,
                draggable: true
            });
            var direccion = "";
            geocodePosition(marker.getPosition());

            function maker_changed(marker) {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                var latlng = new google.maps.LatLng(lat, lng);
                $('#lat').val(lat);
                $('#lng').val(lng);
            }

            $('#buscar').keydown(function (event) {
                if (event.keyCode === 13) {
                    $('#buscar').mouseenter();
                    $('html,body').animate({
                        scrollTop: $('#buscar').offset().top},
                    'slow');
                }
            });

            google.maps.event.addListener(searchBox, 'places_changed', function () {
                try {
                    var address = document.getElementById('buscar').value;

                    geocoder.geocode({'address': address}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            map.setCenter(results[0].geometry.location);
                            marker.setPosition(results[0].geometry.location);
                            var lat = marker.getPosition().lat();
                            var lng = marker.getPosition().lng();
                            var latlng = new google.maps.LatLng(lat, lng);
                            $('#lat').val(lat);
                            $('#lng').val(lng);
                            map.setZoom(16);
                            geocodePosition(latlng);
                        } else {
                            console.log(status);
                            if (status === google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                                return;
                            }
                            if (status === google.maps.GeocoderStatus.ZERO_RESULTS) {

                            }
                        }
                    });
                } catch (e) {
                    console.log(e.message);
                }
            });
            google.maps.event.addListener(marker, 'mouseup', function () {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                var latlng = new google.maps.LatLng(lat, lng);
                geocodePosition(latlng);
            });
            google.maps.event.addListener(marker, 'position_changed', function () {
                maker_changed(marker);
            });
//            geocoding reverse

            function geocodePosition(pos) {
                geocoder.geocode({
                    latLng: pos
                }, function (responses) {
                    try {

                        direccion = responses[0].formatted_address.split(',');
                        console.log(direccion);
                        if (direccion.length === 1) {
                            $('#pais').val(direccion[0]);
                        }
                        if (direccion.length === 2) {
                            $('#pais').val(direccion[1]);
                            $('#direccion').val(direccion[0]);
                        }
                        if (direccion.length === 3) {
                            $('#pais').val(direccion[2]);
                            $('#ciudad').val(direccion[1]);
                            $('#direccion').val(direccion[0]);
                        }
                        if (direccion.length === 4) {
                            $('#pais').val(direccion[3]);
                            $('#ciudad').val(direccion[2]);
                            $('#direccion').val(direccion[1]);
                        }
                    } catch (e) {
                    }
                    $('#buscar').blur();
                });
            }
        }
//AJAX
        $('#enviar').click(function (event) {

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
                    } else {
                        location.href = "{{URL('error500')}}";
                    }
                }
            });
        });
    });


</script>

@endsection