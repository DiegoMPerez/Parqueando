@extends('app')
@section('title')
Permisos
@stop
@section('linktop')
<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>

@endsection
@section('content')
<div class="panel-info" style="margin-bottom: 40px">
    <div class="panel-heading">Permisos</div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th hidden="true">ASD</th>
                    <th>Nombre del Permiso</th>
                    <th>Nombre Visual</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th hidden="true">ASD</th>
                    <th>Nombre del Permiso</th>
                    <th>Nombre Visual</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </tfoot>

            @if(isset($permisos))
            <tbody>
                <!--//este es un comentario-->
                @foreach($permisos as $permiso)
                <tr>
                    <td hidden="true">{!! $permiso->id !!}</td>
                    <td>{!! $permiso->name !!}</td>
                    <td>{!! $permiso->display_name  !!}</td>
                    <td>{!! $permiso->description !!}</td>
                    <td>{!! $permiso->created_at !!}</td>
                    <td>{!! $permiso->updated_at !!} </td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>  
    <ul class="list-group">
        <li class="list-group-item">
            @if(Entrust::can('crear_permisos'))
            {!! Form::open(array('method' => 'get', 'route' => array('permisos.create'))) !!}
            {!! Form::submit('Crear nuevo permiso', array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
            @endif
        </li>
    </ul>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Acciones:</h4>
            </div>
            <div class="modal-body" style="text-align: center">
                <button type="button" class="btn btn-info" data-dismiss="modal" id="btn-editar">Editar</button>
                &nbsp;
                <button type="button" class="btn btn-danger" id="btn-eliminar">Eliminar</button>
                &nbsp;
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancel">Cancelar</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalEliminarLabel">Confirmación</h4>
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



<style>
    #example_filter{
        left: 0px;
        padding: 10px;
    }
    #example_length{
        left: 0px;
        width: 300px;
        padding: 10px;
    }
</style>
@endsection
@section('linkbot')
<script>
    $(document).ready(function () {



        $('#example').DataTable({
            "language": {
                "lengthMenu": "Ver _MENU_ registros por página",
                "zeroRecords": "Nada enconcrado",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Buscar"
            },
            "paging": false,
            "ordering": true,
            "info": false
        });

        var table = $('#example').DataTable();


        $('#example tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }


//MODAL
            var $permisoname = table.row('.selected').data()[1];
            var $asd = table.row('.selected').data()[0];

            $('#myModalLabel').html("Acciones para <strong>" + $permisoname + "</strong> :");

            $("#myModal").modal('show');
            console.log(table.row('.selected').data());
            //table.row('.selected').remove().draw( false );

//ACCIONES MODAL

            $('#btn-editar').click(function () {
                window.location.href = "{{ URL::to('/permisos/editar') }}/" + $asd;
            });

            $('#btn-eliminar').click(function () {
                $("#myModal").modal('hide');
                $('#usuario').html("¿Está seguro de eliminar el permiso <strong>" + $permisoname + "</strong>?");
                $("#modalEliminar").modal('show');


                $('#btn-ok').click(function () {
                    $.ajax({
                        url: '{{ URL::to("/permisos/eliminar") }}',
                        type: 'PUT',
                        dataType: 'json',
                        data: {permiso_id: $asd, "_token": "{{ csrf_token() }}"},
                        success: function (data, textStatus, jqXHR) {
                            $("#modalEliminar").modal('hide');
                            location.href = "{{URL('permisos')}}";
                        }
                    });
                });

            });
        });
    });

</script>

@endsection