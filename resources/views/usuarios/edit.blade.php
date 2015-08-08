@extends('app')

@section('title')
editar usuario
@stop

@section('content')
<div class="container-fluid" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Usuario</div>
                <div class="panel-body">

                    {!! Form::Model($user, array('method' => 'PUT', 'route' => array('usuarios.update', $user->id), 'class' => 'form-horizontal')) !!}
                    <!-- Nombre -->
                    <div class="form-group">
                        {!! Form::label('nombre_usuario', 'Nombre de Usuario:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', null, array('class' => 'form-control')); !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('nombres', 'Nombres:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nombres', null, array('class' => 'form-control')); !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('apellidos', 'Apellidos:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('apellidos', null, array('class' => 'form-control')); !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('rol', 'Rol:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('rol', $roles , $user->rol->id, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">E-Mail</label>
                        <div class="col-md-6">
                            {!! Form::email('email', null, array('class' => 'form-control')); !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password',array('class' => 'form-control')) !!}    
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="enviar">Guardar Cambios</button>
                        </div>
                    </div>
                    
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

