@extends('app')
@section('title')
users
@stop
@section('content')

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr><th>Nombre de Usuario</th><th>Rol</th><th>Email</th><th>Nombres</th><th>Apellidos</th></tr>
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

                <td>{!! Form::open(array('method' => 'GET', 'route' => array('usuarios.edit', $user->id))) !!}
                    {!! Form::submit('Editar', array('class' => 'btn btn-info')) !!}
                    {!! Form::close() !!}</td>

                <td>
                    {!! Form::open(array('id' => 'form-eliminar','method' => 'DELETE', 'route' => array('usuarios.destroy', $user->id))) !!}
                    {!! Form::button('Eliminar', array('class' => 'open btn btn-danger','id' => 'btn-eliminar','data-toggle' => 'modal', 'data-target' => '#myModal', 'data-username' => $user-> nombres, 'data-apellidos' => $user-> apellidos)) !!}
                    {!! Form::close() !!}
                </td>

            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
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
        $('#usuario').html("¿Está seguro de eliminar el usuario <strong>" + $nombres + " " + $apellidos + "</strong>?");
    });


    $('#btn-ok').click(function () {
        $('#form-eliminar').submit();
    });
</script>



<!--alsdljsaljfalsfjsalfjsaljfsaldjf-->
@endsection