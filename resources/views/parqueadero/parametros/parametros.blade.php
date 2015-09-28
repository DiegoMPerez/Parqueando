@extends('app')

@section('title')
Parámetros
@stop

@section('content')


<div class="container-fluid" style="margin-bottom: 30px; position: relative;">
    <div class="row" style="  " >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Parámetros del Parqueadero</div>
                <div class="panel-body">

                    <ul class="list-group">

                        <button type="button" class="btn btn-info" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            Horario - Tarifa
                        </button>   

                    </ul>
                    <div id="form-errors" ></div>
                    <ul class="list-group">
                        <li class="list-group-item">

                            {!! Form::open(['route' => 'roles.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'form' ]) !!}
                            <!-- HORARIO   -->
                            <div class="form-group ">
                                {!! Form::label('nombre', 'Horario', ['class' => 'col-md-2 col-md-offset-0 control-label']) !!}
                            </div>


                            <!-- Hora Inicio -->
                            <div class="form-group">
                                {!! Form::label('nombre', 'Hora Inicio:', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-2">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                </div>
                                {!! Form::label('nombre', 'Hora Fin:', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-2">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                </div>
                            </div>

                            <hr>

                            <!-- TARIFA  -->
                            <div class="form-group ">
                                {!! Form::label('nombre', 'Tarifa', ['class' => 'col-md-2 col-md-offset-0 control-label']) !!}
                            </div>
                            <!-- Por hora -->
                            <div class="form-group">
                                {!! Form::label('nombre', 'Por Hora:', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-3">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                </div>
                            </div>
                            <!-- Semanal -->
                            <div class="form-group">
                                {!! Form::label('nombre', 'Semanal:', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-3">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                </div>
                            </div>
                            <!-- Mensual -->
                            <div class="form-group">
                                {!! Form::label('nombre', 'Mensual:', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-3">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                </div>
                            </div>


                            <div class="form-group" style="text-align: right">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="btn btn-danger" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-info" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-success" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>

<script>

//    $("#enviar").on('click', function () {
//       
//    });
</script>

@stop