@extends('app')
@section('title')
Roles
@stop
@section('linktop')

<link href="{{ asset('/multiselectmaster/css/style.css') }}" rel="stylesheet"/>
<script src="{{ asset('/multiselectmaster/js/multiselect.js') }}"></script>

@stop
@section('content')
<div class="container">
    <div class="user">
        @if(Entrust::can('crear_roles'))
        {!! Form::open(array('method' 
        => 'get', 'route' => array('roles.create'))) !!}
        {!! Form::submit('Crear', array('class'
        => 'btn btn-success')) !!}
        {!! Form::close() !!}
        @endif
        <table class="table table-bordered table-hover">
            <thead>
                <tr><th>Nombre</th><th>Permisos</th></tr>
            </thead>
            @if(isset($roles))
            <tbody>
                @foreach($roles as $rol)
                <tr><td>{{ $rol->name }}</td>
                    <td><a data-toggle="modal" rol_id="{{ $rol->id }}" rol_name="{{ $rol->name }}" data-target="#permisos" class="btn btn-primary get-permisos">Permisos</a></td>
                    @if(Entrust::can('editar_roles'))
                    <td>{!! Form::open(array('method' 
                        => 'GET', 'route' => array('roles.edit', $rol->id))) !!}
                        {!! Form::submit('Editar', array('class'
                        => 'btn btn-info')) !!}
                        {!! Form::close() !!}</td>
                    @endif
                    @if(Entrust::can('eliminar_roles'))
                    <td>
                        {!! Form::open(array('method' 
                        => 'DELETE', 'route' => array('roles.destroy', $rol->id))) !!}
                        {!! Form::submit('Eliminar', array('class'
                        => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>

        <div class="modal" id="permisos">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="titulo">Gestionar permisos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-5">
                                <h5 style="text-align: center">Permisos</h5> 
                                <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <br/>
                                <br/>
                                <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <h5 style="text-align: center">Permisos Asignados</h5> 
                                <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
jQuery(document).ready(function ($) {
  

    $('.get-permisos').on('click', function () {
        $(this).removeData('bs.modal');
        $('#multiselect').empty();
        $('#multiselect_to').empty();
        $('multiselect_rightSelected').empty();
        $('multiselect_leftSelected').empty();
        
        rol_id = $(this).attr('rol_id');
        rol_name = $(this).attr('rol_name');
        
        $('#titulo').html("Gestionar los permisos de <strong>&quot;" + rol_name +"&quot;</strong>");
        
        console.log(rol_id);
        event.preventDefault();
        
           
        $.ajax({
            url: '{{ url('permisos/asignados') }}',
            data: {rol_id: rol_id},
            method: 'GET',
            success: function (data) {
                console.log(data);
                
                $.each(data.permisos, function (index, value) {
                    $('#multiselect').append('<option value="'+value.id+'" >'+value.display_name+'</option>');
                }); 
                
                $.each(data.permisos_a, function (index, value) {
                    $('#multiselect_to').append('<option value="'+value.id+'" >'+value.display_name+'</option>');
                });
                
                $('#multiselect').multiselect('refresh');
            }
        });
        
        
        $('#multiselect').multiselect({
            afterMoveToRight: function (event,options) {
                
               var opciones = [];
               
               for(var i = 0 ; i < options[0].options.length ; i++){
                   opciones[i]=(options[0].options[i].value);
               }
               
               console.log(opciones);
               
               $.ajax({
                        url : '{{ URL::to("/permisos/asignar") }}',
                        type : 'PUT',
                        dataType: 'json',
                        data : {permisos: opciones, rol_id: rol_id,"_token":"{{ csrf_token() }}"}
                    }).done(function(data){
                        console.log(data);
                    });
                
            },
            afterMoveToLeft: function (event,options) {
               
                var opciones = [];
               
               for(var i = 0 ; i < options[0].options.length ; i++){
                   opciones[i]=(options[0].options[i].value);
               }
               
               console.log(opciones);
//               
               $.ajax({
                        url : '{{ URL::to("/permisos/designar") }}',
                        type : 'PUT',
                        dataType: 'json',
                        data : {permisos: opciones, rol_id: rol_id, "_token":"{{ csrf_token() }}"}
                    }).done(function(data){
                        console.log(data);
                    });
                
            }
        });
        
    });
     
});

</script>
@stop