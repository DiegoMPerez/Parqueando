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
        <table class="table table-bordered table-hover">
            <thead>
                <tr><th>Nombre del Rol</th><th>Permisos</th></tr>
            </thead>
            @if(isset($roles))
            <tbody>
                @foreach($roles as $rol)
                <tr><td>{{ $rol->name }}</td>
                    <td><a href="#" data-toggle="modal" data-rol_id="{{ $rol->id }}" data-rol_name="{{ $rol->name }}" data-target="#basicModal" class="btn btn-primary get-permisos">Permisos</a></td>
                    @if(Entrust::can('editar_roles'))
                    <td>{!! Form::open(array('method' 
                        => 'GET', 'route' => array('roles.edit', $rol->id))) !!}
                        {!! Form::submit('Editar', array('class'
                        => 'btn btn-info')) !!}
                        {!! Form::close() !!}</td>
                    @endif
                    @if(Entrust::can('eliminar_roles'))
                    <td>
                        
                        {!! Form::open(array('id' => $rol->id,'method' => 'DELETE', 'route' => array('roles.destroy', $rol->id))) !!}
                        {!! Form::button('Eliminar', array('class' => 'open btn btn-danger','id' => 'btn-eliminar','data-toggle' => 'modal', 'data-target' => '#myModal', 'data-rolname' => $rol->name, 'data-id' => $rol-> id)) !!}
                        {!! Form::close() !!}
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
        <ul class="list-group">
            <li class="list-group-item">
                @if(Entrust::can('crear_roles'))
                    {!! Form::open(array('method' => 'get', 'route' => array('roles.create'))) !!}
                    {!! Form::submit('Crear nuevo rol', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                @endif
            </li>
        </ul>


        <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
            </div>
            <div class="modal-body">
                <p id="usuario"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancel">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-ok">Aceptar</button>
            </div>
        </div>
    </div>
</div>

        

<script type="text/javascript">
    
$(document).ready(function() {
    
    //        {{-- EVENTO DESPUÉS DE CERRAR EL MODAL --}}

    $('#basicModal').on('hidden.bs.modal',function(e){
        $('#multiselect').children('option').remove();
        $('#multiselect_to').children('option').remove();
        $(this).removeData();
    });  
    
    $('#basicModal').on('show.bs.modal',function(event){
        rol_id = $(this).data('bs.modal').options.rol_id;
        rol_name = $(this).data('bs.modal').options.rol_name;
        $('#myModalLabel').html("Gestionar los permisos de <strong>&quot;" + rol_name +"&quot;</strong>");
        
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
        
        
    });
        
        
        $('#multiselect').multiselect({
            
            afterMoveToRight: function (event,options) {
               
               var opciones = [];
               
               for(var i = 0 ; i < options[0].options.length ; i++){
                   opciones[i]=(options[0].options[i].value);
               }
               
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
</script>
@stop

@section('linkbot')
<script>
    $(document).on('click', '.open', function () {
        var $rolname = $(this).data('rolname');
        var $id = $(this).data('id');
        $('#usuario').html("¿Está seguro de eliminar el rol <strong>" + $rolname + "</strong>?");

        $('#btn-ok').click(function () {
            $('#'+$id).submit();
        });
    });



</script>

@endsection