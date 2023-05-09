@extends('layouts.app', ['pageSlug' => 'dashboard'])

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
<input type="text" name="jornada" id="jornada" value="{{ isset($horarios->jornada)?$horarios->jornada:old('jornada') }}" class="form-control" placeholder="Jornada del horario"> </div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="hora_inicio">Hora de inicio</label>
<input type="text" name="hora_inicio" id="hora_inicio" value="{{ $horarios->hora_inicio }}" value="{{ isset($horarios->hora_inicio)?$horarios->hora_inicio:old('hora_inicio') }}" class="form-control" placeholder="Hora de inicio de la clase">
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="hora_final">Hora de final</label>
<input type="text" name="hora_final" id="hora_final" value="{{ isset($horarios->hora_final)?$horarios->hora_final:old('hora_final') }}" class="form-control" placeholder="Hora de final de la clase">
</div>
    </div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="form-group"> <br>
<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" href="/horario"><span class="glyphicon glyphicon-remove"></span> Atrás</button>        </div>
    </div>
</div>
</form>
@endsection
