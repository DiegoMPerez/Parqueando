@extends('app')
@section('title')
Nuevo Tipo Vehículos
@stop

@section('linktop')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('/bootstrapfileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('bootstrapfileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')

<div class="container-fluid" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Tipo de Vehículo</div>
                <div class="panel-body">
                    <div id="form-errors" ></div>
                    {!! Form::open(['route' => 'tipovehiculos.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'form', 'files' => true ]) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nombre', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div> 
                    <!-- Largo -->
                    <div class="form-group">
                        {!! Form::label('largo', 'Largo:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::number('largo', '', ['class' => 'form-control', 'step' => '0.5']) !!}
                        </div>
                    </div> 
                    <!-- Altura -->
                    <div class="form-group">
                        {!! Form::label('altura', 'Altura:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('altura', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div> 
                    <!-- Peso -->
                    <div class="form-group">
                        {!! Form::label('peso', 'Peso:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('peso', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div> 

                    <!-- Descripción -->
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('descripcion', '', ['class' => 'form-control', 'maxlength' => '100']) !!}
                        </div>
                    </div> 
                    <!-- Imagen -->
                    <div class="form-group">
                        {!! Form::label('imagen', 'Imagen:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::file('file') !!}
                        </div>
                    </div>
                    <!--botón enviar-->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="enviar">Crear</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>


<script>
$("#files").fileinput({
    browseIcon: '<i class="glyphicon glyphicon-picture"></i>', previewFileType: "image",
    browseClass: "btn btn-success",
    browseLabel: " Selecciona una imagen",
    showCaption: false,
    showPreview: true,
    showRemove: false,
    showUpload: false,
    fileTypeSettings: ["image"]
});

</script>

@endsection

@section('linkbot')
<script>
    $('#enviar').click(function (event) {

        event.preventDefault();
        var url = "{{URL::route('tipovehiculos.store')}}";
        var form = $('#form');
        var data = form.serialize();
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).closest('form').serialize(),
            success: function (data) {
                // Success...
                console.log(data);
                location.href = "{{URL::route('tipovehiculos.create')}}";
            },
            error: function (jqXhr) {
                if (jqXhr.status === 401) //redirect if not authenticated user.
                    $(location).prop('pathname', 'auth/login');
                if (jqXhr.status === 422) {
                    //process validation errors here.
                    var errors = jqXhr.responseJSON; //this will get the errors response data.
                    //show them somewhere in the markup
                    //e.g
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function (key, value) {
                        console.log();
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';
                    $('#form-errors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                    $('html, body').animate({scrollTop: 0}, 'fast');
                } else {
                    /// do some thing else
                }
            }
        });
    });
</script>
@endsection

