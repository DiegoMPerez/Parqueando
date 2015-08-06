@extends('app')
@section('title')
Tipo Vehiculos
@stop
@section('content')

<div class="panel panel-info">
    <div class="panel-heading">Tipos de vehículos admitidos por los parqueaderos</div>
    <div class="panel-body" >
        <p>El campo <strong>nombre</strong> representa el tipo de vehículos, el valor de <strong>altura</strong> esta representado en <em>metros</em> y el valor de <strong>peso</strong>  en <em>toneladas</em>. </p>
        <ul class="list-group">
            <li class="list-group-item">
                {!! Form::open(array('method' => 'GET', 'route' => array('tipovehiculos.create'))) !!}
                {!! Form::submit('Insertar un nuevo tipo de vehículo', array('class' => 'btn btn-info')) !!}
                {!! Form::close() !!}
            </li>
        </ul>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>Imagen</th><th>Nombre</th><th>Altura</th><th>Largo</th><th>Peso</th><th>Descripción</th></tr>
                </thead>
                @if(isset($tvehiculos))
                <tbody>
                    <!--//este es un comentario-->
                    @foreach($tvehiculos as $tipo)
                    <tr >
                        <td>{!! Html::image("imagenes/".$tipo->imagen,"foto", array("class" => "img-rounded")) !!} </td>
                        <td> <br/> {!! $tipo->nombre !!}</td>
                        <td> <br/> {!! $tipo->altura !!}</td>
                        <td> <br/> {!! $tipo->largo !!}</td>
                        <td> <br/> {!! $tipo->peso !!}</td>
                        <td> <br/> {!! $tipo->descripcion !!}</td>
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
