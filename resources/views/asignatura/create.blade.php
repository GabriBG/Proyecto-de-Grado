@extends('layouts.app', ['pageSlug' => 'crearA'])

@section('content')
<h1>Asignatura</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Ingresar Asignatura</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'asignatura','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}
@csrf

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="codigo">Codigo</label>
<input type="number" name="codigo" id="codigo" value="{{ isset($asignaturas->codigo)?$asignaturas->codigo:old('codigo') }}" class="form-control" placeholder="Digite el codigo de asignatura"> </div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="nombre">Nombre de la asignatura</label>
<input type="text" name="nombre" id="nombre" value="{{ isset($asignaturas->nombre)?$asignaturas->nombre:old('nombre') }}" class="form-control" placeholder="Nombre de asignatura">
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="creditos">Creditos</label>
<input type="text" name="creditos" id="creditos" value="{{ isset($asignaturas->creditos)?$asignaturas->creditos:old('creditos') }}" class="form-control" placeholder="Creditos de la asignatura">
</div>
    </div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span  class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
        </div>
    </div>
</div>

{!!Form::close()!!}
@endsection
