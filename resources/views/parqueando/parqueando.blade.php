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
                <div class="panel-body">

                    <div class="form-group text-center">
                        <label class="col-md-12 col-sm-12"><strong>Información</strong></label>
                        <div class="col-md-12 panel-info" id="infor">
                            <label>lkajsd</label>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {!! link_to('#',"Ruta", array('id'=>'ruta',"class" => "btn-success col-sm-4 col-xs-4 col-md-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 text-center")) !!}
                    </div>
                </div>
                <br/>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {!! link_to('#',"Navegar", array('id'=>'navegar',"class" => "btn-info col-sm-4 col-xs-4 col-md-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4 text-center")) !!}
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

        if ("geolocation" in navigator) {
            console.log("Geolocalización Activada");
            geolocalizacion();
        } else {
            console.log("Geolocalización Desactivada");
        }

        // GEOLOCALIZACIÓN
        function geolocalizacion() {
            if (navigator.geolocation.getCurrentPosition(showPosition)) {
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





//
            var directionsService = new google.maps.DirectionsService();
            var geocoder = new google.maps.Geocoder();
            var image = "{{asset('img/carro.png')}}";

            var directionsDisplay = new google.maps.DirectionsRenderer();

            var mapOptions = {
                center: {lat: _lat, lng: _lng},
                zoom: 15,
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            directionsDisplay.setMap(map);





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


            function maker_changed(marker) {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();

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
                            map.setZoom(16);
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

            google.maps.event.addListener(marker, 'position_changed', function () {
                maker_changed(marker);
            });

            var inicio = new google.maps.LatLng(_lat, _lng);
            var fin = new google.maps.LatLng(0.32285139103669863, -78.10747106931149);

            var beachMarker = new google.maps.Marker({
                position: fin,
                map: map,
                icon: "{{asset('img/marcador_p.png')}}"
            });

            calcRoute(inicio, fin);

            function calcRoute(inicio, fin) {
                //marker.setMap(null);

                //var end = new google.maps.LatLng(38.334818, -181.884886);
                //var end = new google.maps.LatLng(0.32328013765715263, -78.10352295764159);



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

            //botón navegar

            $('#navegar').on('click', function () {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                var latlng = new google.maps.LatLng(lat, lng);
                map.setCenter(latlng);
                map.setZoom(17);
            });
            
            $('#ruta').on('click', function (){
                calcRoute(inicio, fin);
            });

        }
//AJAX
        $('#enviar').click(function (event) {



        });

    });

</script>
@endsection