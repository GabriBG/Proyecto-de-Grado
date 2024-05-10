@extends('layouts.app', ['page' => ('Horarios'),'pageSlug' => 'dashboard'])

@section('content')
<h1>Horario </h1>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Actualizar Horario</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
<form action="{{route('horario.update',$horarios->id)}}" method="post">
{{Form::token()}}
@method('PUT')

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="jornada">Jornada</label>
<select name="jornada" id="jornada" class="form-control">
    <option class="" value="">Seleccione el horario</option>
    <option class="mañana" value="Mañana" {{ isset($horarios) && $horarios->jornada == "Mañana" ? 'selected' : '' }}>Mañana</option>
    <option class="tarde" value="Tarde" {{ isset($horarios) && $horarios->jornada == "Tarde" ? 'selected' : '' }}>Tarde</option>
</select>
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="hora_inicio">Hora de inicio</label>
<input type="time" name="hora_inicio" id="hora_inicio" value="{{ isset($horarios->hora_inicio)?$horarios->hora_inicio:old('hora_inicio') }}" class="form-control" placeholder="Hora de inicio de la clase">
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="hora_final">Hora de final</label>
<input type="time" name="hora_final" id="hora_final" value="{{ isset($horarios->hora_final)?$horarios->hora_final:old('hora_final') }}" class="form-control" placeholder="Hora de final de la clase">
</div>
    </div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<a class="btn btn-danger" href="{{ route('horario.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>        </div>    </div>
</div>
</form>
@endsection
