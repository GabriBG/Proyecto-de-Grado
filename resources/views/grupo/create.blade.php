@extends('layouts.app', ['pageSlug' => 'crearG'])

@section('content')
<h1>Grupo</h1>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Ingresar Grupo</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'grupo','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12"> <div class="form-group">
<label>Estudiantes Matriculados</label>
<input type="text" name="estudiantes_matriculados" value="{{ isset($grupos->estudiantes_matriculados)?$grupos->estudiantes_matriculados:old('estudiantes_matriculados') }}" id="estudiantes_matriculados" class="form-control" placeholder="Numero de estudiantes matriculados">
        </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12"> 
<div class="form-group">
<label>Numero de grupo</label>
<input type="text" name="numero_grupo" value="{{ isset($grupos->numero_grupo)?$grupos->numero_grupo:old('numero_grupo') }}" id="numero_grupo" class="form-control" placeholder="Numero de grupo">
        </div>
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