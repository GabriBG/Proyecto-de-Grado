@extends('layouts.app', ['pageSlug' => 'crearAG'])

@section('content')
<h1>Asignacion de grupos</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Asignar Grupo</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'asignaciongrupo','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}
@csrf

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="docente">Docente</label>
<select class="form-select" name="docente">
    <option class="" value="">Seleccione el docente</option>
    @foreach($personas as $per)
    <option value="{{ $per->id }}">{{ $per->nombre }} {{ $per->apellido }}</option>
    @endforeach
</select> </div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="asignatura">Asignatura</label>
<select class="form-control" name="asignatura">
    <option value="">Seleccione la asignatura</option>
    @foreach($asignaturas as $asig)
    <option value="{{ $asig->id }}">{{ $asig->nombre }}</option>
    @endforeach
</select></div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="grupo">Grupo</label>
<select class="form-control" name="grupo">
    <option value="">Seleccione el grupo</option>
    @foreach($grupos as $gru)
    <option value="{{ $gru->id }}">{{ $gru->numero_grupo }}</option>
    @endforeach
</select></div>
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
