@extends('app')
@section('title')
Editar Tipo Vehículos
@stop

@section('linktop')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('/bootstrapfileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('/bootstrapfileinput/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('/bootstrapfileinput/js/fileinput_locale_es.js') }}"></script>

@endsection

@section('content')

<div class="container-fluid" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Tipo de Vehículo</div>
                <div class="panel-body" style="text-align: center">
                    <div class="panel-info"> <p>El campo <strong>nombre</strong> representa el tipo de vehículos, el valor de <strong>altura</strong> esta representado en <em>metros</em> y el valor de <strong>peso</strong>  en <em>toneladas</em>. </p></div>
                    <div id="form-errors" ></div>
                    {!! Form::Model($tipovehiculo, array('method' => 'PUT', 'route' => array('tipovehiculos.update', $tipovehiculo->id_tipo), 'class' => 'form-horizontal', 'files' => true)) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nombre',null, ['class' => 'form-control', 'maxlength' => '50']) !!}
                        </div>
                    </div> 
                    <!-- Largo -->
                    <div class="form-group">
                        {!! Form::label('largo', 'Largo:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::number('largo', null, ['class' => 'form-control', 'step' => '0.10']) !!}
                        </div>
                    </div> 
                    <!-- Altura -->
                    <div class="form-group">
                        {!! Form::label('altura', 'Altura:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('altura', null, ['class' => 'form-control', 'step' => '0.10']) !!}
                        </div>
                    </div> 
                    <!-- Peso -->
                    <div class="form-group">
                        {!! Form::label('peso', 'Peso:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-2">
                            {!! Form::text('peso', null, ['class' => 'form-control', 'step' => '0.10']) !!}
                        </div>
                    </div> 

                    <!-- Descripción -->
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('descripcion', null, ['class' => 'form-control', 'maxlength' => '255']) !!}
                        </div>
                    </div> 
                    <!--Imagen-->
                    <div class="form-group">
                        {!! Form::label('imagen', 'Imagen Actual:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-1">
                        {!! Html::image("imagenes/".$tipovehiculo->imagen,"foto", array("class" => "img-rounded")) !!} 
                        </div>
                    </div>
                    <!-- Subir Imagen -->
                    <div class="form-group">
                        {!! Form::label('imagen', 'Subir una nueva Imagen:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                             <input id="imagen" type="file" name="imagen" class="form-control">
                        </div>
                    </div>
                    <!--botón enviar-->
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="enviar">Editar Tipo</button>
                            {!! link_to('tipovehiculos',"Cancelar", array("class" => "btn btn-danger")) !!}
                        </div>
                    </div>
                    
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

<script>
//    Delimitaciones del fileinput de bootstrap
$("#imagen").fileinput({
    language: "es",
    allowedFileTypes: ["image"],
    allowedFileExtensions: ["png"],
    browseIcon: '<i class="glyphicon glyphicon-picture"></i>', previewFileType: "image",
    browseClass: "btn btn-success",
    browseLabel: " Selecciona una imagen",
    showRemove: false,
    showUpload: false
});

</script>

@endsection

@section('linkbot')
<script>


    //Envío Ajax
    $('#enviar').click(function (event) {

        var url = "{{URL::route('tipovehiculos.update')}}";
        //Para enviar tipo files XHR2"
        var dataForm = new FormData($('form')[0]);
        dataForm.append('id', {!! $tipovehiculo->id_tipo !!});
        console.log(dataForm);
        event.preventDefault();

        $.ajax({
            url: url,
            type: 'POST',
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#imagen').val(null);
                // Success...
                console.log(data);
                location.href = "{{URL::route('tipovehiculos.index')}}";
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
                        errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></di>';
                    $('#form-errors').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                    $('html, body').animate({scrollTop: 0}, 'fast');
                } else {
                    
                }
            }
        });
    });
</script>
@endsection
