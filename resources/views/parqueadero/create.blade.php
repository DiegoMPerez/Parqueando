@extends('app')
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
                            {!! Form::text('nombre', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>   
<!--Número de plazas-->
                    <div class="form-group">
                        {!! Form::label('numero', 'Número de plazas:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::number('numero', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>  
<!--Teléfono                    -->
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('telefono', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
<!--Ubicación geográfica-->
                    <div class="form-group">
                        {!! Form::label('ubicacion', 'Ubicación Geográfica:', ['class' => 'col-md-4 control-label']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('latitud', 'Latitud:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('latitud', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('longitud', 'Longitud:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('longitud', '', ['class' => 'form-control']) !!}
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