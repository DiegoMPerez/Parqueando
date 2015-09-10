@extends('app')
@section('title')
Roles
@stop
@section('linktop')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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
                    <td><a data-toggle="modal" rol_id="{{ $rol->id }}" data-target="#permisos" class="btn btn-primary get-permisos">Permisos</a></td>
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
                        <h4 class="modal-title">Gestionar permisos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-5">
                                <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                                    @if(isset($permisos))
                                    @foreach($permisos as $permiso)
                                    <option value="{{ $permiso->id }}">{{ $permiso->display_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
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
    $('#multiselect').multiselect();
});
</script>
@stop