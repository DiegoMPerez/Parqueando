@extends('app')
@section('title')
parqueaderos
@stop
@section('linktop')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
@stop
@section('content')

<style>
    #editar{
        background-color: #FED94E; 
        border-color: #FED94E;
    }
    
    #editar:hover{
        background-color: #FFF24E;
        border-color: #FFF24E;
    }
    
    #nombres th{
        text-align: center;
    }
    
</style>

<div class="panel panel-info">
    <div class="panel-heading">Lista de parqueaderos </div>
    <div class="panel-body" >
<!--       {!-- <p>El campo <strong>nombre</strong> representa el tipo de vehículos, el valor de <strong>altura</strong> esta representado en <em>metros</em> y el valor de <strong>peso</strong>  en <em>toneladas</em>. </p> --!} -->
        <ul class="list-group">
            <li class="list-group-item">
                {!! Form::open(array('method' => 'GET', 'route' => array('parqueaderos.create'))) !!}
                {!! Form::submit('Crear un nuevo Parqueadero', array('class' => 'btn btn-info')) !!}
                {!! Form::close() !!}
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table table-striped" style="text-align: center">
                <thead>
                    <tr id="nombres"><th>Nombre del Parqueadero</th><th>Plazas</th><th>Parámetros</th><th>Estado del parqueadero</th><th>Editar</th><th>Eliminar</th></tr>
                </thead>
                @if(isset($parqueaderos))
                <tbody>
                    <!--//este es un comentario-->
                    @foreach($parqueaderos as $parqueadero)
                    <tr><td>{!! $parqueadero->nombre !!}</td>
                        <td> {!! link_to('parqueadero/'.$parqueadero->nombre.'/plazas',"PLAZAS", array("class" => "btn btn-primary")) !!} </td>
                        <td> {!! link_to('parqueadero/'.$parqueadero->nombre.'/parametros',"Parámetros", array("class" => "btn btn-primary")) !!} </td>

                        @if($parqueadero->estado === '1')
                        <td><input type="checkbox" data-toggle="toggle" checked data-on="Activo" data-off="Sin Servicio" data-onstyle="success" data-offstyle="danger"></td>
                        @else
                        <td><input type="checkbox" data-toggle="toggle"  data-on="Activo" data-off="Sin Servicio" data-onstyle="success" data-offstyle="danger"></td>
                        @endif
                        
                        <td><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>

                        <td><button class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td>

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
        $('#usuario').html("¿Está seguro de eliminar el usuario <strong>" + $nombres + " " + $apellidos + "</strong>?");
    });


    $('#btn-ok').click(function () {
        $('#form-eliminar').submit();
    });
</script>



@endsection