@extends('app')
@section('title')
usuarios
@stop
@section('content')
<div class="panel panel-info">
    <div class="panel-heading">Lista de Usuarios </div>
    <div class="panel-body" >

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>Nombre de Usuario</th><th>Rol</th><th>Email</th><th>Nombres</th><th>Apellidos</th><th>Editar</th><th>Eliminar</th></tr>
                </thead>
                @if(isset($users))
                <tbody>
                    <!--//este es un comentario-->
                    @foreach($users as $user)
                    <tr><td>{!! $user->name !!}</td>
                        <td>{!! $user->rol->name !!}</td>
                        <td>{!! $user->email !!}</td>
                        <td>{!! $user->nombres !!}</td>
                        <td>{!! $user->apellidos  !!}</td>
                        @if(Entrust::can('editar_usuarios'))
                        <td>{!! Form::open(array('method' => 'GET', 'route' => array('usuarios.edit', $user->id))) !!}
                            <button class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                            {!! Form::close() !!}</td>
                        <td>
                            {!! Form::open(array('id' => $user->id,'method' => 'DELETE', 'route' => array('usuarios.destroy', $user->id))) !!}
                            {!! Form::button('', array('class' => 'open btn btn-danger glyphicon glyphicon-remove','id' => 'btn-eliminar','data-toggle' => 'modal', 'data-target' => '#myModal', 'data-username' => $user-> nombres, 'data-apellidos' => $user-> apellidos, 'data-id' => $user-> id)) !!}
                            {!! Form::close() !!}
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
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
@endsection
@section('linkbot')
<script>
    $(document).on('click', '.open', function () {
        var $nombres = $(this).data('username');
        var $apellidos = $(this).data('apellidos');
        var $id = $(this).data('id');
        $('#usuario').html("¿Está seguro de eliminar el usuario <strong>" + $nombres + " " + $apellidos + "</strong>?");


        $('#btn-ok').click(function () {
            $('#' + $id).submit();
        });
    });



</script>

@endsection