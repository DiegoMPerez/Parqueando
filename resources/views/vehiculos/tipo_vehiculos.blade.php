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
                        <td> 
                            {!! Form::open(array('method' => 'GET', 'route' => array('tipovehiculos.edit', $tipo->id_tipo))) !!}
                            {!! Form::submit('Editar', array('class' => 'btn btn-info')) !!}
                            {!! Form::close() !!}</td>

                        <td>
                        <td>
                            {!! Form::open(array('id' => $tipo->id_tipo, 'method' => 'DELETE', 'route' => array('tipovehiculos.destroy', $tipo->id_tipo))) !!}
                            {!! Form::button('Eliminar', array('class' => 'open btn btn-danger','id' => 'btn-eliminar','data-toggle' => 'modal', 'data-target' => '#myModal', 'data-nombre' => $tipo-> nombre, 'data-id' => $tipo-> id_tipo)) !!}
                            {!! Form::close() !!}
                        </td>
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
        var $nombre = $(this).data('nombre');
        var $id = $(this).data('id');
        $('#usuario').html("¿Está seguro de eliminar el tipo  <strong>" + $nombre + "</strong>?");

        $('#btn-ok').click(function (e) {
            $('#'+$id).submit();
        });
    });



</script>
@endsection
