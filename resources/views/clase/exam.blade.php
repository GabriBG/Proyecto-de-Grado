@extends('layouts.app', ['page' => ('Clases'),'pageSlug' => 'dashboard'])

@section('content')
<h1>Examinar Clase</h1>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <h4>Clase</h4>
@if (count($errors)>0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error) <li>{{$error}}</li>
@endforeach
</ul> </div>
@endif
    </div>
</div>
<form action="{{route('clase.update', $clases->id)}}" method="post">
{{Form::token()}}
@method('PUT')

<div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
    <label for="grupo_asignado" style="color:white;">Grupo Asignado</label>
    <input type="text" name="grupo_asignado" id="grupo_asignado" style="color:white" class="form-control" value="{{ $clases->asignacionGrupos->grupos->numero_grupo }}" readonly>
</div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-5">
    <div class="form-group">
        <label for="persona" style="color:white;">Docente:</label>
        <input type="text" name="persona" id="persona" style="color:white" class="form-control" value="{{ $clases->asignacionGrupos->personas->nombre }} {{ $clases->asignacionGrupos->personas->apellido }}" readonly>
    </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="asignatura" style="color:white;">Asignatura:</label>
        <input type="text" name="asignatura" id="asignatura" style="color:white" class="form-control" value="{{ $clases->asignaturas->nombre }}" readonly>
    </div>
    </div>
    </div>
    <br>
    <div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="horario" style="color:white;" >Horario:</label>
        <input type="text" name="grupo_asignado" id="grupo_asignado" style="color:white" class="form-control" value="{{ $clases->horarios->hora_inicio }} - {{ $clases->horarios->hora_final }}" readonly>
 </div>
        </div>
                <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="jornada" style="color:white;">Jornada:</label>
                        <input type="text" name="jornada" id="jornada" style="color:white" class="form-control" value="{{ $clases->horarios->jornada }}" readonly>
                    </div>
                    </div>

        </div>
        <br>
    <div class="row">
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="aula" style="color:white;" >Aula:</label>
        <input type="text" name="grupo_asignado" id="grupo_asignado" style="color:white" class="form-control" value="{{ $clases->aulas->nomenclatura }}" readonly>
 </div>
        </div>
            <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="sede" style="color:white;">Sede:</label>
                    <input type="text" name="sede" id="sede" style="color:white" class="form-control" value="{{ $clases->aulas->sede }}" readonly>
                </div>
                </div>

        </div>
    <br>
    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="fecha" style="color:white;">Fecha:</label>
            <input class="form-control" type="date" style="color:white;" value="{{ old('fecha', \Carbon\Carbon::parse($clases->fecha)->format('Y-m-d')) }}" name="fecha" id="fecha" readonly>
        </div>
    </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="sede" style="color:white;">Confirmar Asistencia:</label>
                @if($clases->asistencia=='asistida')
                <div class="form-check">
                    <input class="" type="radio" name="asistencia" id="asistencia" checked>
                    <label class="form-check-label" for="asistencia" value="asistida" style="color:white">
                      Asistida
                    </label>
                  </div>
                  @elseif($clases->asistencia=='inasistida')
                  <div class="form-check">
                    <input class="" type="radio" name="asistencia" id="asistencia" checked>
                    <label class="form-check-label" for="asistencia" value="inasistida" style="color:white">
                      Inasistencia
                    </label>
                  </div>
                  @else
                  <div class="form-check">
                    <input class="" type="radio" name="asistencia" id="asistencia">
                    <label class="form-check-label" for="asistencia" value="asistida" style="color:white">
                      Asistida
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="" type="radio" name="asistencia" id="asistencia">
                    <label class="form-check-label" for="asistencia" value="inasistida" style="color:white">
                      Inasistencia
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="" type="radio" name="asistencia" id="asistencia" checked>
                    <label class="form-check-label" for="pendiente" value="pendiente" style="color:white">
                      Pendiente
                    </label>
                  </div>
                  @endif
            </div>
    </div>
    <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
    <div class="form-group">
        <label for="modalidad" style="color:white;">Modalidad:</label>
        <input type="text" name="modalidad" id="modalidad" style="color:white" class="form-control" value="{{ ucfirst($clases->modalidad) }}" readonly>
</div>
</div>
</div>
<br>

    <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-ok"></span> Guardar</button>
    <a class="btn btn-danger" href="{{ route('clase.index') }}"><span class="glyphicon glyphicon-remove"></span> Atrás</a>
       </div>        </div>
    </div>
</div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! Html::script('./js/metodos.js') !!}
@endsection
