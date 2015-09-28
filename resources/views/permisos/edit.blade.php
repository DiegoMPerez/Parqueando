@extends('app')

@section('title')
editar permiso
@stop

@section('content')


<div class="container-fluid" style="margin-bottom: 30px; position: relative;">
    <div class="row" style="  " >
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Editar un Permiso</div>
                <div class="panel-body">


                    <div id="form-errors" ></div>

                    {!! Form::Model($permiso, array('method' => 'PUT', 'route' => array('permisos.update', $permiso->id), 'class' => 'form-horizontal')) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre del Permiso:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div>
                    <!-- Nombre Visual -->
                    <div class="form-group">
                        {!! Form::label('nombrev', 'Nombre Visual:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::text('display_name', null, ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div>
                    <!-- Descripción -->
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => '200']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="enviar">Editar</button>
                            {!! link_to('permisos',"Cancelar", array("class" => "btn btn-danger")) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $("#enviar").on('click', function () {
        event.preventDefault();
        console.log($(this).parent().context.form.action);
        var url = $(this).parent().context.form.action;
        var form = $('#form');
        var data = form.serialize();
        $.ajax({
            url: url,
            type: 'PUT',
            data: $(this).closest('form').serialize(),
            success: function (data) {
                // Success...
                //console.log(data);
                location.href = "{{URL('permisos')}}";
            }, error: function (jqXhr) {
                if (jqXhr.status === 401) //redirect if not authenticated user.
                    $(location).prop('pathname', 'auth/login');
                if (jqXhr.status === 422) {
                    //process validation errors here.
                    var errors = jqXhr.responseJSON; //this will get the errors response data.
                    //show them somewhere in the markup                 //e.g
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function (key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';
                    $('#form-errors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                    $('html, body').animate({scrollTop: 0}, 'fast');
                }
                if (jqXhr.status === 403) {
                    location.href = "{{URL('error403')}}";
                }
                 else {

                }
            }
        });

    });
</script>

@stop