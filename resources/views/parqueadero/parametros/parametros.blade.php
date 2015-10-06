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
                    <div id="content-ht">

                        <ul id="template" class="list-group" hidden="true">
                            <ul id="template" class="list-group">
                            <li class="list-group-item">
                                {!! Form::open(['route' => 'roles.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'form' ]) !!}
                                <!-- HORARIO   -->
                                <div class="form-group ">
                                    {!! Form::label('lhorario', 'Horario', ['class' => 'col-md-2 col-md-offset-0 control-label']) !!}
                                </div>


                                <!-- Hora Inicio -->
                                <div class="form-group">
                                    {!! Form::label('lhinicio', 'Hora Inicio:', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-3">
                                        <div class="input-group clockpicker" id="clock">
                                            {!! Form::text('hinicio', '', ['class' => 'form-control', 'maxlength' => '100', 'autocomplete' => 'off']) !!}
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                    {!! Form::label('lhfin', 'Hora Fin:', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-3">
                                        <div class="input-group clockpicker" id="clock">
                                            {!! Form::text('hfin', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <!-- TARIFA  -->
                                <div class="form-group ">
                                    {!! Form::label('ltarifa', 'Tarifa', ['class' => 'col-md-2 col-md-offset-0 control-label']) !!}
                                </div>
                                <!-- Por hora -->
                                <div class="form-group">
                                    {!! Form::label('lxhora', 'Por Hora:', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-3">
                                        {!! Form::text('xhora', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                    </div>
                                </div>
                                <!-- Semanal -->
                                <div class="form-group">
                                    {!! Form::label('lxsemana', 'Semanal:', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-3">
                                        {!! Form::text('xsemana', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                    </div>
                                </div>
                                <!-- Mensual -->
                                <div class="form-group">
                                    {!! Form::label('lxmes', 'Mensual:', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-3">
                                        {!! Form::text('xmes', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                                    </div>
                                </div>


                                <div class="form-group" style="text-align: right">
                                    <div class="col-md-6 col-md-offset-4">
                                        {{-- CANCELAR --}}
                                        <button type="button" class="btn btn-danger" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                        {{--ELIMINAR CONTENIDO--}}
                                        <button type="button" class="btn btn-info" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                                        </button>
                                        {{--ENVIAR - GUARDAR--}}
                                        <button name="guardar" type="submit" class="btn btn-success" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                        </button>
                                        {{--IMAGEN--}}
                                        <div style="float: right; padding-left: 20px">{!! Html::image("imagenes/numeros/n.png","1", array("class" => "img-rounded","id"=>"imagen", "style" => "height: 35px")) !!}</div>
                                    </div>
                                </div>
                                {!! Form::close() !!}

                            </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
$(document).ready(function (event) {
  
  
    
  
    $('.clockpicker').clockpicker({
        placement: 'bot',
        align: 'left',
        donetext: 'ACEPTAR'
    });

    $('#add').on('click', function (event) {
        
//        {{-- Guardar Horario Tarifa --}}
    
        event.preventDefault();
        $.ajax({
               url: '{{ URL::to("/parqueadero/parametro/guardar") }}',
               type: 'PUT',
               dataType: 'json',
               data: {parqueadero: "{{$parqueadero}}", "_token": "{{ csrf_token() }}"},
               success: function (json) {
                   var $p_id=json['p_id'];
                   var $ht_id=json['ht_id'];
                   console.log($p_id, $ht_id);
                   $.ajax({
                        url: '{{ URL::to("/parqueadero/parametro") }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {parqueadero: $p_id,ht:$ht_id, "_token": "{{ csrf_token() }}"},
                        success: function (data, textStatus, jqXHR) {
                            
                        }
                    });
               }
           });

           var $html = $('#template').clone();
           var $form = $html.find('form');
           $('#content-ht').append($($html.html()));


       });
   


    function clokPickerUpdate() {
        $("ul").each(function () {
            $('.clockpicker').clockpicker({
                placement: 'bottom',
                align: 'top',
                donetext: 'ACEPTAR'
            });
        });
    }

    function cargarDatos() {
        
        @foreach($horarios as $horario)
            var $html = $('#template').clone();
            var $form = $html.find('form');

            // Action
            $form.attr('action', "{{URL('/parqueadero')}}"+"/{{$horario['pivot_id_parqueadero']}}"+"/parametro/{{$horario['id_horario']}}/{{$horario['id_tarifa']}}");
            
            //Horarios
            
            $form.find('[name=hinicio]').attr('value', "{!! $horario['hora_inicio'] !!}");
            $form.find('[name=hfin]').attr('value', "{!! $horario['hora_fin'] !!}" );
            
              
            //Tarifas
            
            $form.find('[name=xhora]').attr('value',  "{!! $horario['por_hora'] !!}" );
            $form.find('[name=xsemana]').attr('value',  "{!! $horario['semanal'] !!}" );
            $form.find('[name=xmes]').attr('value',  "{!! $horario['mensual'] !!}" );
            
            $form.find('[id=imagen]').attr('src', "{!! asset('imagenes/numeros/') !!}/{{$horario['numero']}}.png" );

            $('#content-ht').append($($html.html()));
        @endforeach
    }

    cargarDatos();
    clokPickerUpdate();
    
    $(".form-horizontal").submit(function (event){
        event.preventDefault();
        var $form =$(this).serialize();
        var $url = $(this).attr('action');
        
        $.ajax({
               url: $url,
               type: 'PUT',
               dataType: 'json',
               data: $form,
               success: function (json) {
               }
        });
    });
    
});

</script>


<script id="ul">




</script>

@stop