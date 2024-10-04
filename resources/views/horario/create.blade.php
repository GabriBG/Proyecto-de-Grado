@extends('layouts.app', ['page' => ('Horarios'),'pageSlug' => 'crearH'])

@section('content')
<h1>Horario </h1>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Ingresar Horario</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'horario','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12"> <div class="form-group">
<label for="email">Jornada</label>
<select class="form-control" name="jornada">
    <option class=""value="">Seleccione el horario</option>
    <option class="Mañana" value="Mañana">Mañana</option>
    <option class="Tarde" value="Sabatina">Sabatina</option>
</select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="email">Hora de inicio</label>
<input type="time" name="hora_inicio" id="hora_inicio" value="{{ isset($horarios->hora_inicio) ? $horarios->hora_inicio : old('hora_inicio') }}" class="form-control">
        </div>
    </div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="documento">Hora de final</label>
<input type="time" name="hora_final" id="hora_final" value="{{ isset($horarios->hora_final) ? $horarios->hora_final : old('hora_final') }}" class="form-control"> </div>
</div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection
