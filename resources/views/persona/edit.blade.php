@extends('layouts.app', ['page' => ('Personas'),'pageSlug' => 'dashboard'])

@section('content')

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Actualizar Persona</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
<form action="{{route('persona.update',$personas->id)}}" method="post">
{{Form::token()}}
@method('PUT')

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="documento">Numero Documento</label>
<input type="number" name="documento_identidad" id="documento_identidad" value="{{ isset($personas->documento_identidad)?$personas->documento_identidad:old('documento_identidad') }}" class="form-control" placeholder="Digite el número Documento"> </div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="nombre">Nombres</label>
<input type="text" name="nombre" id="nombre" value="{{ $personas->nombre }}" value="{{ isset($personas->nombre)?$personas->nombre:old('nombre') }}" class="form-control" placeholder="Nombre Completo">
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="apellido">Apellidos</label>
<input type="text" name="apellido" id="apellido" value="{{ isset($personas->apellido)?$personas->apellido:old('apellido') }}" class="form-control" placeholder="Apellidos Completos">
</div>
    </div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12"> <div class="form-group">
<label for="email">Email</label>
<input type="text" name="email" id="email" value="{{ isset($personas->users->email)?$personas->users->email:old('email') }}" class="form-control" placeholder="Correo Electrónico">
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="password">Contraseña</label>
<input type="password" name="password" id="password" value="{{ $personas->users->password }}" value="{{ isset($personas->users->password)?$personas->users->password:old('password') }}" class="form-control" placeholder="Contraseña">
<button type="button" class="icon" id="togglePassword"><span class="tim-icons icon-zoom-split"></button></span>
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="email">Telefono</label>
<input type="text" name="telefono" id="telefono" value="{{ isset($personas->telefono)?$personas->telefono:old('telefono') }}" class="form-control" placeholder="Telefono">
        </div>
    </div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
    <label for="role">Rol:</label>
{!! Form::model($personas, ['route' => ['persona.update', $personas], 'method' => 'put']) !!}
<select name="role" id="role" class="form-control">
    @foreach($roles as $role)
        <option value="{{ $role->id }}" {{ $personas->users->roles->contains($role) ? 'selected' : '' }}>
            {{ $role->name }}
        </option>
    @endforeach
</select>
</div>
</div>
{!! Form::close() !!}
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<a class="btn btn-danger" href="{{ route('persona.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>        </div>    </div>
</div>
</form>

@endsection
<script>
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.querySelector('input[name="password"]');
    const passwordPlainInput = document.querySelector('input[name="password_plain"]');

    togglePasswordBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordPlainInput.value = passwordInput.value;
            togglePasswordBtn.textContent = 'Ocultar contraseña';
        } else {
            passwordInput.type = 'password';
            passwordPlainInput.value = '';
            togglePasswordBtn.textContent = 'Mostrar contraseña';
        }
    });
</script>
