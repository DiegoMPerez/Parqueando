@extends('app')
@section('title')
WEB PARQUEANDO
@endsection
@section('linktop')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet"/>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
<link href="{{asset('bootstrap-slider/css/slider.css')}}"/>
<script src="{{asset('bootstrap-slider/js/bootstrap-slider.js')}}"></script>
<script src="{{asset('bootstrap-slider/js/modernizr.js')}}"></script>
@stop
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places,drawing&ext=.js"></script>
<div class="panel-info" style="margin-bottom: 40px">
    <div class="panel-heading">Busca un parqueadero</div>
    <div class="panel-body" >
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="form-group">
                    {!! Form::label('buscar', 'Buscar Lugar:', ['class' => 'col-md-2 col-xs-12 control-label']) !!}
                    <div class=" col-md-12 col-xs-12">
                        {!! Form::text('buscar', '', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group ">
                    <div class="panel panel-default col-md-8 col-sm-8 col-xs-12">
                        <div class="panel-body">
                            <div class="form-group text-center">
                                <label class="col-md-12 col-sm-12"><strong>Información</strong></label>
                                <div class="col-md-12 panel-info" id="infor">
                                    <label>lkajsd</label>
                                </div>

                            </div>
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
                <br>
                <div class="form-group">
                    <label class="col-md-8 col-xs-12 control-label">Área de búsqueda 2<em>km</em> &nbsp; <input id="area_b" type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="warning"></label>

                </div>
                <div class="form-group">
                    <div class="panel-body"></div>
                </div>
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">
                <div id="map-canvas"></div>        
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header text-warning">
                        <button type="button" class="close" data-dismiss="modal"></button>
                        <h4 class="modal-title" id="titulo">Activa el GPS</h4>
                    </div>
                    <div class="modal-body" id="mensaje">
                        <p>Este servicio requiere la activación del GPS, por favor activa y recarga la página.</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    var _radio = 2;

    $('#sl1').slider({
        formater: function (value) {
            return 'Current value: ' + value;
        }
    });




    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, handle_error);
    } else {
        error('not supported');
    }
    function handle_error(err) {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $('#myModal').modal('show');
        } else {
            $('#titulo').text("Permite compartir la ubicación");
            $('#mensaje').text("Este servicio necesita acceso a tu ubicación, por favor recarga la página y permite compartir la ubicación.");
            $('#myModal').modal('show');
        }
    }


    function showPosition(position) {
        if (position) {
            _lat = position.coords.latitude;
            _lng = position.coords.longitude;
        } else {

            return false;
            //_lat = 0.3212001155157536;
            //_lng = -78.10052093275755;
        }


        var inicio = new google.maps.LatLng(_lat, _lng);
        var fin = new google.maps.LatLng(0.32285139103669863, -78.10747106931149);



        var directionsService = new google.maps.DirectionsService();
        var geocoder = new google.maps.Geocoder();
        var image = {
            url: "{{asset('img/carro.png')}}",
        };
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var mapOptions = {
            center: {lat: _lat, lng: _lng},
            zoom: 15};
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
        var searchBox = new google.maps.places.SearchBox(document.getElementById('buscar'));
        var marker = new google.maps.Marker({
            position: {
                lat: _lat,
                lng: _lng
            },
            map: map,
            draggable: true,
            icon: image
        });

        buscarParqueaderos(_lat, _lng);

        var inicio = new google.maps.LatLng(_lat, _lng);

        function maker_changed(marker) {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            inicio = new google.maps.LatLng(lat, lng);
            $('#area_b').change();
        }

        google.maps.event.addListener(marker, 'mouseup', function () {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            var latlng = new google.maps.LatLng(lat, lng);
            marker.setMap(null);
            calcRoute(latlng, fin);
            marker.setMap(map);
            buscarParqueaderos(lat,lng);
        });

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
                        //map.setZoom(16);
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
        var beachMarker = new google.maps.Marker({
            position: fin,
            map: map,
            icon: "{{asset('img/marcador_p.png')}}"
        });
        calcRoute(inicio, fin);
        function calcRoute(inicio, fin) {
            directionsDisplay.setDirections({routes: []});
            //marker.setMap(null);

            //var end = new google.maps.LatLng(38.334818, -181.884886);
            //var end = new google.maps.LatLng(0.32328013765715263, -78.10352295764159);


            var bounds = new google.maps.LatLngBounds();
            bounds.extend(inicio);
            bounds.extend(fin);
            map.fitBounds(bounds);
            var request = {
                origin: inicio, destination: fin,
                travelMode: google.maps.TravelMode.DRIVING,
            };
            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay = new google.maps.DirectionsRenderer(
                            {
                                preserveViewport: true,
                                suppressMarkers: true
                            });
                    directionsDisplay.setDirections(response);
                    directionsDisplay.setMap(map);
                } else {
                    $('#titulo').text("Error al calcular la ruta");
                    $('#mensaje').text("No se puede calcular la ruta desde su ubicación.");
                    $('#myModal').modal('show');
                    //alert("No existe respuesta para esta ruta " + inicio.toUrlValue(6) + " to " + fin.toUrlValue(6) + " failed: " + status);
                }
            });
        }


        var circle = new google.maps.Circle({
            center: inicio,
            //radio en metros
            radius: 20000,
            fillColor: "#F0AD4E",
            fillOpacity: 0.3,
            strokeOpacity: 0.0,
            strokeWeight: 0
        });
        function dibujarArea() {
            circle.setCenter(inicio);
            circle.setMap(map);
        }

        function eliminarArea() {
            circle.setMap(null);
        }

        //botón navegar

        $('#navegar').on('click', function () {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            var latlng = new google.maps.LatLng(lat, lng);
            map.setCenter(latlng);
            map.setZoom(18);
        });
        $('#ruta').on('click', function () {
            calcRoute(inicio, fin);
        });
        //Activar área

        $('#area_b').change(function () {
            eliminarArea();
            if ($(this).prop('checked')) {
                dibujarArea();
            }
        });

        //PARQUEADEROS
        function buscarParqueaderos(lat,lng) {
            //AJAX
            $(document).ready(function () {
                $.ajax({
                    type: 'GET',
                    url: "{{URL('/parqueando/parqueaderos')}}",
                    data: {lat: lat, lng: lng, radio: _radio},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, element) {
                            console.log(element);
                        });
                    }
                });

            });
        }

    }

});

</script>
@endsection