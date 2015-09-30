@extends('app')

@section('title')
Parámetros
@stop

@section('linktop')
<link href="{{ asset('/clockpicker/dist/bootstrap-clockpicker.css') }}" rel="stylesheet"/>
<script src="{{ asset('/clockpicker/dist/bootstrap-clockpicker.js')}}"></script>
@stop

@section('content')


<div class="container-fluid" style="margin-bottom: 30px; position: relative;">
    <div class="row" style="  " >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Parámetros del Parqueadero</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <button id="add" type="button" class="btn btn-info" aria-label="Left Align">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            Horario - Tarifa
                        </button>   
                    </ul>
                    <div id="form-errors" ></div>
                    <div id="ht">
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
$(document).ready(function () {
    $('.clockpicker').clockpicker({
        placement: 'bot',
        align: 'left',
        donetext: 'ACEPTAR'
    });

    $('#add').on('click', function () {
        $('#ht').append($('#ul').html());
        $("ul").each(function () {
            $('.clockpicker').clockpicker({
                placement: 'bottom',
                align: 'top',
                donetext: 'ACEPTAR',
            });
        });
    });

});
</script>


<script id="ul">

                     <ul id="ht" class="list-group">
                        <li class="list-group-item">

                            {!! Form::open(['route' => 'roles.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'form' ]) !!}
                            <!-- HORARIO   -->
                            <div class="form-group ">
                                {!! Form::label('nombre', 'Horario', ['class' => 'col-md-2 col-md-offset-0 control-label']) !!}
                            </div>


                            <!-- Hora Inicio -->
                            <div class="form-group">
                                {!! Form::label('nombre', 'Hora Inicio:', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-3">
                                    <div class="input-group clockpicker" id="clock">
                                        {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off']) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                {!! Form::label('nombre', 'Hora Fin:', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-3">
                                    <div class="input-group clockpicker" id="clock">
                                        {!! Form::text('name', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>


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
                                    <div style="float: right; padding-left: 20px">{!! Html::image("imagenes/numeros/1.png","1", array("class" => "img-rounded", "style" => "height: 35px")) !!}</div>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </li>
                    </ul>
          

</script>

@stop