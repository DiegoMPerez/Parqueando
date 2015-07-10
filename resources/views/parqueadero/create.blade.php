@extends('app')
@section('linktop')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
@endsection

@section('content')
<div class="container-fluid">
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

                    {!! Form::open(['route' => 'parqueaderos.store', 'role' => 'form', 'class' => 'form-horizontal' ]) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nombre', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div>   
                    <!--Número de plazas-->
                    <div class="form-group">
                        {!! Form::label('numero', 'Número de plazas:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::number('numero', '', ['class' => 'form-control', 'min' => '0', 'max' => '999']) !!}
                        </div>
                    </div>  
                    <!--Teléfono                    -->
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('telefono', '', ['class' => 'form-control', 'maxlength' => '10']) !!}
                        </div>
                    </div>
                    <!--Ubicación geográfica-->
                    <div class="form-group">
                        {!! Form::label('ubicacion', 'Ubicación Geográfica:', ['class' => 'col-md-4 control-label']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('buscar', 'Buscar:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('buscar', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('latitud', 'Latitud:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('lat', '', ['class' => 'form-control', 'id' => 'lat']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('longitud', 'Longitud:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('lng', '', ['class' => 'form-control', 'id' => 'lng']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div id="map-canvas" style="height: 200px "></div>
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-primary">Crear</button>
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
<script type="text/javascript">


    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: {lat: -34.397, lng: 150.644},
        zoom : 15
    });
    
    var marker = new google.maps.Marker({
        position: {
            lat: -34.397,
            lng: 150.644
        },
        map: map,
        draggable: true
    });
    
    var searchBox = new google.maps.places.SearchBox(document.getElementById('buscar'));
    
    google.maps.event.addListener(searchBox, 'places_changed', function(){
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for(i=0; place=places[i];i++){
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
        }
        map.fitBounds(bounds);
        map.setZoom(15);
    });
    
    google.maps.event.addListener(marker, 'position_changed', function(){
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        $('#lat').val(lat);
        $('#lng').val(lng);
    });

</script>

@endsection