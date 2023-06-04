@extends('layouts.app', ['page' => ('Clases'), 'pageSlug' => 'crearC'])



@section('content')
<h1 style="color:yellow">Registrar Clase</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <br>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
{!!Form::open(array('url'=>'clase','method'=>'POST','autocomplete'=>'off') )!!}
{{Form::token()}}
@csrf

<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
<label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
<select class="form-control" style="color=#FFFFFF;" name="grupo_asignado" id="grupo_asignado">
    <option class="" value="">Seleccione el grupo</option>
    @foreach($asignacionGrupos as $asigna)
    <option value="{{ $asigna->id  }}">{{ $asigna->grupos->numero_grupo }}</option>
    @endforeach
</select> </div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
<div class="form-group">
    <label for="persona" style="color:white;">Docente:</label>
    <input type="text" name="persona" id="persona" style="color:white;" class="form-control" readonly>
</div>
</div>
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
    <label for="asignatura" style="color:white;">Asignatura:</label>
    <input type="text" name="asignatura" id="asignatura" style="color:white;" class="form-control" readonly>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
    <label for="horario" style="color:white;" >Horario:</label>
    <select class="form-control" style="color=#FFFFFF;" name="horario" id="horario">
        <option class=""  value="">Seleccione el horario</option>
        @foreach($horarios as $hora)
        <option value="{{ $hora->id  }}">{{ $hora->hora_inicio }} - {{ $hora->hora_final }}</option>
        @endforeach
    </select> </div>
    </div>
            <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="jornada" style="color:white;">Jornada:</label>
                    <input type="text" name="jornada" id="jornada" style="color:white;" class="form-control" readonly>
                </div>
                </div>

    </div>
    <br>
<div class="row">
<div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
<div class="form-group">
    <label for="aula" style="color:white;" >Aula:</label>
    <select class="form-control" style="color=#FFFFFF;" name="aula" id="aula">
        <option class=""  value="">Seleccione el aula</option>
        @foreach($aulas as $aul)
        <option value="{{ $aul->id  }}">{{ $aul->nomenclatura }}</option>
        @endforeach
    </select> </div>
    </div>
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="sede" style="color:white;">Sede:</label>
                <input type="text" name="sede" id="sede" style="color:white;" class="form-control" readonly>
            </div>
            </div>

    </div>
    <br>
    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="fecha" style="color:white;">Fecha:</label>
            <input class="form-control" type="date" name="fecha" id="fecha">
        </div>
    </div>
    </div>
    <br>
<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="asistencia" style="color:white;">Asistencia:</label>
        <select class="form-control" style="color=#FFFFFF;" name="asistencia" id="asistencia">
            <option class=""  value="">Seleccione el aula</option>
            <option class=""  value="asistida">Asistida</option>
            <option class=""  value="inasistida">Inasistida</option>
            <option class=""  value="pendiente">Pendiente</option>
        </select>
    </div>
</div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="modalidad" style="color:white;">Modalidad:</label>
        <select class="form-control" style="color=#FFFFFF;" name="modalidad" id="modalidad">
            <option class=""  value="">Seleccione el aula</option>
            <option class=""  value="presencial">Presencial</option>
            <option class=""  value="virtual">Virtual</option></select>    </div>
</div>
</div>
<br>

<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><span  class="glyphicon glyphicon-remove"></span> Vaciar Campos</button>
<br>
<br>
<label style="color:white;">¿No encuentra su horario o aula?</label>
<br>
<a style="color:rgb(33, 222, 255);" target="_blank" href="{{route('horario.create')}}">Registrar Horario</a>
<br>
<a style="color:rgb(0, 217, 255);" target="_blank" href="{{route('aula.create')}}">Registrar Aula</a>

{!!Form::close()!!}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! Html::script('./js/metodos.js') !!}

@endsection



