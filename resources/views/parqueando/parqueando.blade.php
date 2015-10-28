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
    function mapLocation() {
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;

        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var chicago = new google.maps.LatLng(37.334818, -121.884886);
            var mapOptions = {
                zoom: 7,
                center: chicago
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            directionsDisplay.setMap(map);
            //google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
            calcRoute();
        }

        function calcRoute() {
            var start = new google.maps.LatLng(37.334818, -121.884886);
            //var end = new google.maps.LatLng(38.334818, -181.884886);
            var end = new google.maps.LatLng(37.441883, -122.143019);
            var image = "{{asset('img/marcador_car.png')}}";
            var beachMarker = new google.maps.Marker({
                position: start,
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
            bounds.extend(start);
            bounds.extend(end);
            map.fitBounds(bounds);
            var request = {
                origin: start,
                destination: end,
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
                    alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    }
    mapLocation();


</script>
@endsection