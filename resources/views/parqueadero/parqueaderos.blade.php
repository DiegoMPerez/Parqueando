@extends('app')
@section('title')
parqueaderos
@stop
@section('content')
<div class="panel-default">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr><th>Nombre del Parqueadero</th><th>plazas</th><th>parámetros</th><th>editar</th><th>eliminar</th></tr>
            </thead>
            @if(isset($parqueaderos))
            <tbody>
                <!--//este es un comentario-->
                @foreach($parqueaderos as $parqueadero)
                <tr><td>{!! $parqueadero->nombre !!}</td>

                    <td> {!! link_to('parqueadero/'.$parqueadero->nombre.'/plazas',"PLAZAS", array("class" => "btn btn-primary")) !!} </td>
                    <td>paRÁmetros</td>
                    <td>editar</td>

                    <td>eliminar</td>

                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
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
        $('#usuario').html("¿Está seguro de eliminar el usuario <strong>" + $nombres + " " + $apellidos + "</strong>?");
    });


    $('#btn-ok').click(function () {
        $('#form-eliminar').submit();
    });
</script>

@endsection