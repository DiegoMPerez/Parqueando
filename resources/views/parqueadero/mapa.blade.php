@extends('app')
@section('link')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
var map;
function initialize() {
  map = new google.maps.Map(document.getElementById('map-canvas'), {
    zoom: 8,
    center: {lat: -34.397, lng: 150.644}
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@endsection

@section('content')
<div class="center-block" >
    <div id="map-canvas" style="height: 300px"></div>
</div>
@endsection