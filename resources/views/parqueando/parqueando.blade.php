@extends('app')
@section('title')
WEB PARQUEANDO
@endsection
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places,drawing&ext=.js"></script>
<div class="panel-info" style="margin-bottom: 40px">
    <div class="panel-heading">Busca un parqueadero</div>
    <div class="panel-body" >
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                    {!! Form::label('buscar', 'Buscar Lugar:', ['class' => 'col-md-2 col-xs-12 control-label']) !!}
                    <div class="col-md-10 col-xs-12">
                        {!! Form::text('buscar', '', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group text-center">
                    {!! Form::label('buscar', 'Información', ['class' => 'col-md-12 control-label']) !!}
                    <div class="col-md-12 panel-info" id="infor">
                        <label>lkajsd</label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {!! link_to('parqueaderos',"IR", array("class" => "btn-success col-sm-4 col-xs-4 col-md-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 text-center")) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="panel-body"></div>
                </div>


            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">
                <div id="map-canvas"></div>        
            </div>

        </div>
        <!--<input type="button" id="routebtn" value="route" />-->
    </div>
</div>

<style>
    #map-canvas {
        flex-align: auto;
        height: 400px;
        width: auto;
        margin: 0px;
        padding: 0px
    }


</style>
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

            var directionsService = new google.maps.DirectionsService();
            var geocoder = new google.maps.Geocoder();
            var image = "{{asset('img/marcador_car.png')}}";
            
            var directionsDisplay = new google.maps.DirectionsRenderer();
            
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
                draggable: false,
                icon: image
            });    
            
            var inicio = new google.maps.LatLng(_lat, _lng);
            var fin = new google.maps.LatLng(0.3190745, -78.107557);
            
            calcRoute(inicio, fin);
            
            function maker_changed(marker) {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                var latlng = new google.maps.LatLng(lat, lng);
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
            });
            google.maps.event.addListener(marker, 'position_changed', function () {
                maker_changed(marker);
            });

            
            function calcRoute(inicio, fin) {
                
                //var end = new google.maps.LatLng(38.334818, -181.884886);
                //var end = new google.maps.LatLng(0.32328013765715263, -78.10352295764159);
                var beachMarker = new google.maps.Marker({
                    position: inicio,
                    map: map,
                    icon: image
                });
                /* var startMarker = new google.maps.Marker({
                 position: start,
                 map: map,
                 draggable: false,
                 icon: "{{asset('img/car.png')}}"
                 });
                 var endMarker = new google.maps.Marker({
                 position: end,
                 map: map,
                 draggable: false
                 });*/

                var bounds = new google.maps.LatLngBounds();
                bounds.extend(inicio);
                bounds.extend(fin);
                map.fitBounds(bounds);
                var request = {
                    origin: inicio,
                    destination: fin,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay = new google.maps.DirectionsRenderer(
                                {
                                    suppressMarkers: true
                                });
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);
                    } else {
                        alert("Directions Request from " + inicio.toUrlValue(6) + " to " + fin.toUrlValue(6) + " failed: " + status);
                    }
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

</script>
@endsection