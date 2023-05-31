@extends('layouts.app', ['pageSlug' => 'crearH'])

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
{!!Form::open(array('url'=>'persona','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12"> <div class="form-group">
<label for="email">Jornada</label>
<select class="form-control">
    <option class="" value="">Seleccione el horario</option>
    <option class="diurna" value="">Diurna</option>
    <option class="nocturna" value="">Nocturna</option>
</select>
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="email">Hora de inicio</label>
<input type="text" name="hora_inicio" value="{{ isset($horarios->hora_inicio)?$horarios->password:old('hora_inicio') }}" id="hora_inicio" class="form-control" placeholder="Hora de inicio">
        </div>
    </div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="documento">Hora de final</label>
<input type="number" name="hora_final" value="{{ isset($personas->hora_final)?$personas->hora_final:old('hora_final') }}" id="hora_final" class="form-control" placeholder="Hora de final"> </div>
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
