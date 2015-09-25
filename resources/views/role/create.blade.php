@extends('app')

@section('title')
crear roles
@stop

@section('content')


<div class="container-fluid" style="margin-bottom: 30px; position: relative;">
    <div class="row" style="  " >
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Crear un Rol</div>
                <div class="panel-body">

                    {!! Form::open(['route' => 'parqueaderos.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'form' ]) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre del Rol:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('nombre', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div>
                    <!-- Nombre Visual -->
                    <div class="form-group">
                        {!! Form::label('nombrev', 'Nombre Visual:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('visual', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div>
                    <!-- Descripción -->
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('descripcion', '', ['class' => 'form-control', 'maxlength' => '200']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="enviar">Crear</button>
                            {!! link_to('roles',"Cancelar", array("class" => "btn btn-danger")) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@stop